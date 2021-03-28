<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Domain\Models\Users;
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

$factory->define(Users::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'email' => $faker->email,
        'telephone' => $faker->phoneNumber,
        'cpf' => $faker->integer(11),
        'obs' => $faker->paragraph,
        'status' => $faker->randomElement([0, 1]),
    ];
});
