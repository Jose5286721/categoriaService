<?php

use App\Categoria;
use App\SubCategoria;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		// $this->call('UsersTableSeeder');
		factory(Categoria::class, 10)->create();
		factory(SubCategoria::class, 10)->create();
	}
}
