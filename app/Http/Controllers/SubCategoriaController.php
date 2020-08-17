<?php
namespace App\Http\Controllers;
use App\SubCategoria;

class SubCategoriaController extends Controller {
	public function index() {
		return SubCategoria::all();
	}
	public function show($idSubCategoria) {
		return SubCategoria::findOrFail($idSubCategoria);
	}
}
