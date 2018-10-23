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
        'surname' => $faker->name,
        'phone' => $faker->e164PhoneNumber,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Trip::class, function (Faker $faker) {

    return [
        'carrier_id' => $faker->numberBetween($min = 1, $max = 50),
        'start_dt' => $faker->dateTime,
        'end_dt' => $faker->dateTime,
        'from' => $faker->address,
        'to' => $faker->address
    ];
});

$factory->define(App\Rating::class, function (Faker $faker) {

    return [
        'from_user_id' => $faker->numberBetween($min = 1, $max = 50),
        'to_user_id' => $faker->numberBetween($min = 1, $max = 50),
        'rate_value' => $faker->numberBetween($min = 1, $max = 50),
        'comment' => $faker->name
    ];
});

$factory->define(App\Luggage::class, function (Faker $faker) {

   return [
        'owner_id' => $faker->numberBetween($min = 1, $max = 50),
        'taker_id' => $faker->numberBetween($min = 1, $max = 50),
        'takerName' => $faker->name,
        'takerPhone1' => $faker->phoneNumber,
        'takerPhone2' => $faker->phoneNumber,
        'mass' => $faker->numberBetween($min = 1, $max = 50),
        'comertial' => $faker->boolean($chanceOfGettingTrue = 50),
        'value' => $faker->word,
        'price' => $faker->word,
        'from' => $faker->address,
        'to' => $faker->address,
        'start_dt' => $faker->dateTime,
        'end_dt' => $faker->dateTime,

    ];
});

$factory->define(App\Offer::class, function (Faker $faker) {

    return [
        'req_user_id' => $faker->numberBetween($min = 1, $max = 50),
        'luggage_id' => $faker->numberBetween($min = 1, $max = 50),
        'trip_id' => $faker->numberBetween($min = 1, $max = 50),
        'agree' => $faker->numberBetween($min = 1, $max = 9),
        'status' => $faker->word

    ];
});