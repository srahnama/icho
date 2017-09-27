<?php

use Faker\Generator as Faker;

$factory->define(\App\Message::class, function (Faker $faker) {
    return [
        //
        'text' => $faker->text(100),
        'user_id' => rand(1,15),
        'answer' => false

    ];
});
