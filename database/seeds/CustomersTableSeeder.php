<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Customer::create([
           'name' => 'Javra Software',
           'slug' => 'javra',
           'contact_person' => 'Infra',
            'email' => 'infra@javra.com'
        ]);
    }
}
