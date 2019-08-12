<?php

use Illuminate\Database\Seeder;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Attribute::create([
            'name' => 'CPU',
        ]);

        \App\Attribute::create([
            'name' => 'Memory',
        ]);


        \App\Attribute::create([
            'name' => 'Disk',
        ]);

    }
}
