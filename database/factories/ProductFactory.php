<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {

    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);

    return [
        'name' => $faker->name,
        'intro' => $faker->sentence(),
        'content' => $faker->text(),
        'sales' => 0,
        'is_sale' => 1,
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
