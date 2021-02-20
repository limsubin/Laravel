<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Board::class, function (Faker $faker) {
    $minId = User::min('id');
    $maxId = User::max('id');
    //select min(id) form users;
    //select max(id) form users;
    return [
       'title'=>$faker->word(10),
       'content'=>$faker->sentence,
       'user_id'=>$faker->numberBetween($minId, $maxId),
    ];
});
