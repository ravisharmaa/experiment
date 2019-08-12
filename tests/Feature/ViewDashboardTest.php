<?php

namespace Tests\Feature;

use App\Customer;
use App\Server;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewDashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_can_not_view_the_dashboard()
    {
        $this->get('/')->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function a_user_must_be_a_customer_to_view_the_dashboard()
    {
        $userNotAsCustomer = factory(User::class)->create();

        $this->actingAs($userNotAsCustomer)->get('/')
            ->assertStatus(404);

        $userAsCustomer = factory(User::class)->create([
            'customer_id' => factory(Customer::class)->create()->id,
        ]);

        $this->actingAs($userAsCustomer)->get('/')
            ->assertStatus(200);

    }

    /**
     * @test
     */
    public function user_cannot_view_servers_of_unrelated_customers()
    {
        $user = factory(User::class)->create([
            'customer_id' => factory(Customer::class)->create()->id
        ]);

        $unrelatedServer = factory(Server::class)->create([
            'customer_id' => factory(Customer::class)->create()->id
        ]);


        $this->actingAs($user)->get('/')
            ->assertDontSee($unrelatedServer->hostname);
    }

    /**
     * @test
     */
    public function user_can_view_servers_of_related_customers()
    {
        $johnDoe = factory(User::class)->create([
            'name'=>'John',
            'customer_id' => factory(Customer::class)->create()->id
        ]);

        $serverRelatedToJohn = factory(Server::class)->create([
            'customer_id' => $johnDoe->customer_id
        ]);


        $janeDoe = factory(User::class)->create([
            'name'=>'Jane',
           'customer_id' => factory(Customer::class)->create()->id
        ]);

        $serverRelatedToJane = factory(Server::class)->create([
            'customer_id' => $janeDoe->customer_id
        ]);


        $this->actingAs($johnDoe)->get('/')
            ->assertSee($serverRelatedToJohn->hostname)
            ->assertDontSee($serverRelatedToJane->hostname);

    }

    /**
     * @test
     */
    public function super_admin_can_view_all_servers_regardless_of_associations()
    {
        $user = factory(User::class)->create([
            'email' => 'admin@javra.com', //Super admin is admin@javra.com
        ]);

        $server = factory(Server::class)->create([
            'customer_id'=> factory(Customer::class)->create()->id
        ]);


        $this->actingAs($user)->get('/')
            ->assertSee($server->fresh()->hostname);
    }
}
