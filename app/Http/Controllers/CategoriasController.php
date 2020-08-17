<?php
namespace App\Http\Controllers;
use App\Categoria;
use App\SubCategoria;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\Json\CategoriaJson;
use App\Http\Resources\Json\CategoriasJson;
class CategoriasController extends Controller {
	use ApiResponse;
	public function index() {
		return Categoria::paginate();
	}
	public function indexCountByEmpresa($idEmpresa) {
		return $this->successResponse(Categoria::where("empresa_id", $idEmpresa)->get()->count());
	}
	public function indexByEmpresa(Request $request, $idEmpresa) {
		if($request->has("nopage")){
			return CategoriasJson::collection(Categoria::where("empresa_id", $idEmpresa)->get());
		}
		return CategoriasJson::collection(Categoria::where("empresa_id", $idEmpresa)->paginate());
	}
	public function show($id) {
		$categoria = Categoria::findOrFail($id);
		return $this->successResponse(new CategoriaJson($categoria));
	}
	public function showSubCategoriasByEmpresa($idEmpresa) {
		$categorias = Categoria::where("empresa_id", $idEmpresa)->get();
		$subcategorias = array();
		foreach($categorias as $categoria){
			foreach($categoria->subcategorias as $subcategoria){
				array_push($subcategorias,$subcategoria);
			}
		}
		return $this->successResponse($subcategorias);
	}
	public function showSubCategoriasByIdCategoria($id) {
		$categoria = Categoria::findOrFail($id);
		return $this->successResponse($categoria->subcategorias);
	}
	public function storeSubCategoriaByEmpresa(Request $request, $idEmpresa) {
		$categoria = Categoria::where("empresa_id", $idEmpresa)->first();
		$this->validate($request, [
			"nombre" => "required|string|max:255",
			"categoria_id" => "required|string|min:1",
		]);
		$parametros = $request->all();
		$parametros["empresa_id"] = $idEmpresa;
		$subCategoria = SubCategoria::create($parametros);
		return $this->successResponse($subCategoria);
	}
	public function storeSubCategoriaByIdCategoria(Request $request, $id) {
		$categoria = Categoria::findOrFail($id);
		$this->validate($request, [
			"nombre" => "required|string|max:255",
			"empresa_id" => "required|string|min:1",
		]);
		$parametros = $request->all();
		$parametros['categoria_id'] = $id;
		$subCategoria = SubCategoria::create($parametros);
		return $this->successResponse($subCategoria);
	}
	public function store(Request $request) {
		$this->validate($request, [
			"nombre" => "required|string|max:255",
			"descripcion" => "required|string",
			"empresa_id" => "required|string|min:1",
		]);
		$parametros = $request->all();
		$categoria = Categoria::create($parametros);
		return $this->successResponse($categoria, Response::HTTP_CREATED);
	}

	public function update(Request $request, $id) {
		$this->validate($request, [
			"nombre" => "string|max:255",
			"descripcion" => "string",
		]);
		$categoria = Categoria::findOrFail($id);
		$categoria->fill($request->all());
		if ($categoria->isClean()) {
			return $this->errorResponse("Modifica almenos un campo", Response::HTTP_UNPROCESSABLE_ENTITY);
		}
		$categoria->save();
		return $this->successResponse($categoria);
	}

	public function updateSubCategoria(Request $request, $idSubCategoria) {
		$subcategoria = SubCategoria::findOrFail($idSubCategoria);
		$this->validate($request, [
			"nombre" => "required|string",
		]);
		$subcategoria->fill($request->all());
		$subcategoria->save();
		return $this->successResponse($subcategoria);
	}

	public function destroy($id) {
		$categoria = Categoria::findOrFail($id);
		$categoria->delete();
		return $this->successResponse($categoria);
	}

	public function deleteSubCategoriaByIdCategoria($idSubCategoria) {
		$subcategoria = SubCategoria::findOrFail($idSubCategoria);
		$subcategoria->delete();
		return $this->successResponse($subcategoria);
	}
}
