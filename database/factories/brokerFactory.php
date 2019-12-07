<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\broker;
use Faker\Generator as Faker;

$factory->define(broker::class, function (Faker $faker) {
    return [
            'name' => $faker->name(),
            'phone' => $faker->phoneNumber(),
            'address' => $faker->address(),
    ];
});
