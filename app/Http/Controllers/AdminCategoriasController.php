<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;

class AdminCategoriasController extends Controller
{
    private $model;

    public function __construct(Categorias $categorias){
        $this->model = $categorias;
       // $this->model->timestamps = false;
    }

    public function index(){
        $categorias = $this->model->all();
        return view('admin.categorias.index', ['categorias' => $categorias]);
    }

    public function create(){
        return view('admin.categorias.create-edit');
    }

    public function store(Request $request){
        $categoria = $this->model;
        $categoria->Nome = $request['nome'];
        $categoria->save();
        return redirect('/');
    }

    public function destroy($categoriaId){
        $this->model->find($categoriaId)->delete();
        return redirect()->back();
    }

    public function edit($categoriaId){
        $categoria = $this->model->find($categoriaId);
        return view('admin.categorias.create-edit', ['categoria' => $categoria]);
    }

    public function update(Request $request){
        $categoria = $this->model->find($request['Id']);
        $categoria->Nome = $request['nome'];
        $categoria->save();
        return redirect()->action('AdminCategoriasController@index');
    }
}
