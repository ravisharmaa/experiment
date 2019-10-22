<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'slug' => $faker->slug,
        'contact_person' => $faker->name,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'remarks' => $faker->text,
        'address' => $faker->address,
    ];
});

$factory->define(App\Server::class, function (Faker $faker) {
    return [
        'hostname' => $faker->url,
        'ipaddress' => $faker->localIpv4,
        'customer_id' => function () {
            return factory(App\Customer::class)->create()->id;
        },
    ];
});

$factory->state(App\Server::class, 'specific_host_for_csv', function () {
    return [
        'customer_id' => function () {
            return factory(App\Customer::class)->create()->id;
        },
        'hostname' => 'example.com',
        'ipaddress' => '1.1.1.1',
    ];
});
