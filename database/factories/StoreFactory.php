<?php

use Faker\Generator as Faker;

$sale_arr = [
    ['min' => 1, 'max' => 4, 'rate' => 0.1],
    ['min' => 5, 'max' => 9, 'rate' => 0.15],
    ['min' => 10, 'max' => 0, 'rate' => 0.2],
];

$saleRate = json_encode($sale_arr);
$subordinateRate = '0.1';

$factory->define(App\Models\Store::class, function (Faker $faker) use ($saleRate, $subordinateRate) {
    return[
        'name' => $faker->name,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'sale_rate' => $saleRate,
        'subordinate_rate' => $subordinateRate,
    ];
});
