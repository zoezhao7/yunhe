<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'password' => Hash::make('123123'),
        'phone' => $faker->phoneNumber,
        'idnumber' => $faker->creditCardNumber,
        'intro' => $faker->sentence,
        'type' => 2,
    ];
});
