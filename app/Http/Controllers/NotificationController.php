<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function redirect(string $id): RedirectResponse
    {
        $notification = Auth::user()
            ->notifications()
            ->whereId($id)
            ->first();

        $notification->markAsRead();

        return redirect($notification->data['url'] ?? route('dashboard'));
    }
}
