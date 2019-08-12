<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_can_not_create_users()
    {
        $this->get('/')
        ->assertRedirect('/login');
    }

    /**
     * @skipped
     */
    public function super_user_can_create_roles()
    {
        $user = factory(User::class)->create([
            'email' => 'admin@javra.com',
        ]);
    }
}
