<?php

use Faker\Generator as Faker;
use App\User;
use App\Book;
use App\BooksCategory;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(BooksCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->word()
    ];
});

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->words(5,true),
        'description' => $faker->paragraph(1),
        'user_id' => User::all()->random()->id,
        'books_category_id' => BooksCategory::all()->random()->id,
    ];
});

