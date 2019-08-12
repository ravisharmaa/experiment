<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
           'name' => 'javra',
           'customer_id'=>1,
           'email' => 'admin@javra.com',
           'password' => 'javra123'
        ]);
    }
}
