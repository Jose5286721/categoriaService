<?php
namespace App\Http\Resources\Json;
use Illuminate\Http\Resources\Json\JsonResource;
class CategoriaJson extends JsonResource{
    public function toArray($request){
        return [
            "nombre" => $this->nombre,
            "descripcion" => $this->descripcion,
            "icono" => $this->icono,
            "subcategorias" => $this->subcategorias()->get()
        ];
    }
}