<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use App\UserSocial;
use Illuminate\Support\Facades\Auth;
use App\User;

class SocialController extends Controller
{
    /**
     * Redirect page to social media account permission.
     *
     * @param Request $request
     * @param string $driver
     * @return void
     */
    public function redirect(Request $request, string $driver)
    {
        $service = config('services.'.$driver);

        if (is_null($service)) {
            return redirect()
                ->route('login')
                ->withError(__('Social media driver is not available.'));
        }

        return Socialite::driver($driver)->redirect();
    }

    /**
     * Handle data from social media.
     * 1. Register if user and/or email is not exists.
     * 2. Login with existing user if email addres found in database.
     *
     * @param Request $request
     * @param string $driver
     * @return void
     */
    public function handle(Request $request, string $driver)
    {
        if ($request->has('error')) {
            // user rejected app permission
            return redirect()
                ->route('login')
                ->withError(__('Permission has been canceled.'));
        }

        $social = Socialite::driver($driver)->user();

        // check if user provider is already exists
        $socliate = UserSocial::whereDriverName($driver)
            ->whereDriverId(sha1($social->getId()))
            ->with('user')
            ->take(1)
            ->first();

        if (! empty($socliate) and ! empty($socliate->user)) {
            Auth::loginUsingId($socliate->user->id);

            return redirect()->route('dashboard');
        }

        if (is_null($social->getEmail())) {
            // redirect to register form and user must fill email and password manually
            session()->put('user.social', [
                'driver' => $driver,
                'id' => $social->getId(),
                'name' => $social->getName(),
                'photo' => $social->getAvatar(),
            ]);
            
            return redirect()->route('register');
        }

        $user = User::whereEmail($social->getEmail())->first();

        if (! empty($user)) {
            $userSocial = UserSocial::firstOrNew([
                'user_id' => $user->id,
                'driver_name' => $driver,
            ])
            ->fill([
                'driver_id' => $social->getId(),
                'name' => $social->getName(),
                'email' => $social->getEmail(),
                'photo' => $social->getAvatar(),
            ]);

            $userSocial->save();
        } else {
            DB::transaction(function () use (&$user, $driver, $social) {
                $user = User::create([
                    'name' => $social->getName(),
                    'email' => $social->getEmail(),
                    'password' => '',
                    'remember_token' => str_random(100),
                ]);

                $userSocial = UserSocial::create([
                    'user_id' => $user->id,
                    'driver_name' => $driver,
                    'driver_id' => $social->getId(),
                    'name' => $social->getName(),
                    'email' => $social->getEmail(),
                    'photo' => $social->getAvatar(),
                ]);
            });
        }

        if (! empty($user)) {
            Auth::loginUsingId($user->id);
        }

        return redirect()->route('dashboard');
    }
}
