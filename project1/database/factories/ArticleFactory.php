<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'user_id'=> App\Models\User::all()->random()->id,
        'title' =>$faker->name,
        'description'=>$faker->text,
        'status'=> rand(0,1),
    ];
});
