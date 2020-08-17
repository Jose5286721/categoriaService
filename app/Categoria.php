<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {

	protected $fillable = [
		"nombre", "descripcion", "icono", "empresa_id",
	];
	public function subcategorias() {
		return $this->hasMany('App\SubCategoria');
	}
}
