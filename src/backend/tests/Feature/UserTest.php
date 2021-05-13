<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = new \App\User();
        $user->name = "鈴木";
        $user->email = "suzuki@test.com";
        $user->password = \Hash::make('password');
        $user->save();

        $readUser = \App\User::where('name', '鈴木')->first();
        $this->assertNotNull($readUser);
        $this->assertTrue(\Hash::check('password', $readUser->password));
        \App\User::where('email', 'suzuki@test.com')->delete(); //
    }
}
