<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marcas;

class AdminMarcasController extends Controller
{
    private $model;

    public function __construct(Marcas $marcas){
        $this->model = $marcas;
       // $this->model->timestamps = false;
    }

    public function index(){
        $marcas = $this->model->all();
        return view('admin.marcas.index', ['marcas' => $marcas]);
    }

    public function create(){
        return view('admin.marcas.create-edit');
    }

    public function store(Request $request){
        $marca = $this->model;
        $marca->Nome = $request['nome'];
        $marca->save();
        return redirect('/');
    }

    public function destroy($marcaId){
        $this->model->find($marcaId)->delete();
        return redirect()->back();
    }

    public function edit($marcaId){
        $marca = $this->model->find($marcaId);
        return view('admin.marcas.create-edit', ['marca' => $marca]);
    }

    public function update(Request $request){
        $marca = $this->model->find($request['Id']);
        $marca->Nome = $request['nome'];
        $marca->save();
        return redirect()->action('AdminMarcasController@index');
    }
}
