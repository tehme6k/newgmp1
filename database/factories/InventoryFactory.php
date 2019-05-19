<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Inventory;
use Faker\Generator as Faker;

$factory->define(Inventory::class, function (Faker $faker) {
    return [
        'product_id' => rand(1, 12),
        'amount' => rand(-2000, 2000),
        'created_by' => 1
    ];
});
