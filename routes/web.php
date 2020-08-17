<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->group(["prefix" => "api/categorias","middleware" => "secret"], function () use ($router) {
	$router->get("", "CategoriasController@index");
	$router->get("/empresa/{idEmpresa}", "CategoriasController@indexByEmpresa");
	$router->get("/empresa/{idEmpresa}/count", "CategoriasController@indexCountByEmpresa");
	$router->get("/empresa/{idEmpresa}/subcategorias", "CategoriasController@showSubCategoriasByEmpresa");
	$router->get("/{id}", "CategoriasController@show");
	$router->get("/subcategorias/{idSubCategoria}","SubCategoriaController@show");
	$router->get("/{id}/subcategorias", "CategoriasController@showSubCategoriasByIdCategoria");
//  $router->get("/empresa/{idEmpresa}/subcategorias/{idSubCategoria}", "CategoriasController@showSubCategoriasByEmpresaAndSubCategoriaId");

	$router->post("", "CategoriasController@store");
	$router->post("/empresa/{idEmpresa}/subcategorias", "CategoriasController@storeSubCategoriaByEmpresa");
	$router->post("/{id}/subcategorias", "CategoriasController@storeSubCategoriaByIdCategoria");

	$router->put("/{id}", "CategoriasController@update");
	$router->put("/subcategorias/{idSubCategoria}", "CategoriasController@updateSubCategoria");

	$router->delete("/{id}", "CategoriasController@destroy");
	$router->delete("/subcategorias/{idSubCategoria}", "CategoriasController@deleteSubCategoriaByIdCategoria");
});
