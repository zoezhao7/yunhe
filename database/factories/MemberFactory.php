<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Member::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'idnumber' => $faker->creditCardNumber,
    ];
});
