<?php

use Faker\Generator as Faker;

$factory->define(\App\Message::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->optional()->regexify('33[0-9]{8}'),
        'mensaje' => $faker->paragraph(rand(2, 5)),
        'user_id' => $faker->optional()->randomElement(\App\User::pluck('id')->toArray())
    ];
});
