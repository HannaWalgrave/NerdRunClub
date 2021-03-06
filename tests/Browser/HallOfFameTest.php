<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user){
            $browser->visit('https://humansvszombies.weareimd.be/hall-of-fame')
                    ->assertSee('Hall of fame');
        });

    }
}
