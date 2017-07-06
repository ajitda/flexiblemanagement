<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'role' => $faker->word,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Supplier::class, function (Faker\Generator $faker) {
    return [
        'supplier_name' => $faker->name,
        'address' => $faker->address,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'phone' => $faker->phoneNumber,
        'user_id' => $faker->numberBetween($min=1, $max = 25),
    ];
});


$factory->define(App\Purchase::class, function (Faker\Generator $faker) {
    return [
        'qty' => $faker->numberBetween($min=1, $max = 100),
        'weight' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
        'tweight' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
        'price_per_kg' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
        'sub_total' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
        'death_qty' => $faker->numberBetween($min=1, $max = 25),
        'transport' => $faker->numberBetween($min=1000, $max = 2500),
        'daily_stuff_salary' => $faker->numberBetween($min=1000, $max = 5000),
        'others' => $faker->numberBetween($min=1000, $max = 5000),
        'total' => $faker->numberBetween($min=10000, $max = 50000),
        'payment' => $faker->numberBetween($min=10000, $max = 50000),
        'supplier_id' => $faker->numberBetween($min=1, $max = 25),

    ];
});


$factory->define(App\Expense::class, function (Faker\Generator $faker) {
    return [
        'expense_category_id' => $faker->numberBetween($min=1, $max = 6),
        'description' => $faker->sentence,
        'qty' => $faker->numberBetween($min=1, $max = 100),
        'unit_expense' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
        'total' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
        'user_id' => $faker->numberBetween($min=1, $max = 15),
    ];
});

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'phone' => $faker->phoneNumber,
        'payment' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
        'balance' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
        'user_id' => $faker->numberBetween($min=1, $max = 25),
    ];
});

$factory->define(App\Sale::class, function (Faker\Generator $faker) {
    return [
        'qty' => $faker->numberBetween($min=1, $max = 100),
        'weight' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
        'tweight' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
        'price_per_kg' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
        'sub_total' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
        'death_qty' => $faker->numberBetween($min=1, $max = 25),
        'total' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
        'payment' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
        'dues' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
        'supplier_id' => $faker->numberBetween($min=1, $max = 25),
        'customer_id' => $faker->numberBetween($min=1, $max = 25),

    ];
});


$factory->define(App\FeedSupplier::class, function (Faker\Generator $faker) {
    return [
        'supplier_name' => $faker->name,
        'address' => $faker->address,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'phone' => $faker->phoneNumber,
        'user_id' => $faker->numberBetween($min=1, $max = 25),
    ];
});


$factory->define(App\FeedCustomer::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'phone' => $faker->phoneNumber,
        'payment' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
        'balance' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
        'user_id' => $faker->numberBetween($min=1, $max = 25),
    ];
});