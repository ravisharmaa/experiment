<?php

namespace Tests\Unit;

use App\Customer;
use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_user_belongs_to_a_customer()
    {
        $customer = factory(Customer::class)->create();
        $user = factory(User::class)->create();
        $user->associateCustomer($customer);

        $this->assertInstanceOf(Customer::class, $user->customer);
        $this->assertInstanceOf(BelongsTo::class, $user->customer());
    }

    /**
     * @test
     */
    public function user_can_be_associated_to_a_customer()
    {
        $customer = factory(Customer::class)->create();
        $user = factory(User::class)->create();

        $user->associateCustomer($customer);

        $this->assertSame($customer->id, $user->customer_id);
    }

    /**
     * @test
     */
    public function that_javra_is_the_super_user()
    {
        $normalUser = factory(User::class)->create();

        $adminUser = factory(User::class)->create(['email'=>'admin@javra.com']);

        $this->assertFalse($normalUser->isAdmin());

        $this->assertTrue($adminUser->isAdmin());
    }
}
