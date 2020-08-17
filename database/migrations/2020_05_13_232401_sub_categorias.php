<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubCategorias extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('sub_categorias', function (Blueprint $table) {
			$table->id();
			$table->string('nombre');
			$table->unsignedBigInteger('categoria_id');
			$table->unsignedBigInteger('empresa_id');
			$table->timestamps();
			$table->foreign('categoria_id')->references('id')->on('categorias');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('sub_categorias');
	}
}
