<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model {
	protected $fillable = [
		"nombre", "categoria_id", "empresa_id",
	];
}
