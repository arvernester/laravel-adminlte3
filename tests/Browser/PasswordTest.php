<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class PasswordTest extends DuskTestCase
{
    /**
     * Test reset with email address.
     *
     * @return void
     */
    public function testEmail()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use($user) {
            $browser->visit('/password/reset')
                ->type('email', $user->email)
                ->assertPathIs('/password/reset');
        });
    }
}
