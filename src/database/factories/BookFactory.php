<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Book;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'author' => $faker->name,
        'title' => $faker->words(rand(1,10), true),
    ];
});
