<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categoria;
use App\SubCategoria;
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
$factory->define(SubCategoria::class, function (Faker $faker) {
	return [
		'nombre' => $faker->word,
		'categoria_id' => $faker->numberBetween(1, 10),
	];
});

$factory->define(Categoria::class, function (Faker $faker) {
	return [
		'nombre' => $faker->word,
		'descripcion' => $faker->words(5, true),
	];
});
