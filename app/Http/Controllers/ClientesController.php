<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;


class ClientesController extends Controller
{
    public function create()
    {
        $cidades = \App\Cidade::all();
        return view('clientes.create-edit', ['cidades' => $cidades]);
    }

    public function store(Request $request, Clientes $cliente)
    {
        $request = $request->except('_token');
        $request['UserId'] = \Auth::user()->id;
        $cliente->fill($request); 
        $cliente->save();
        return redirect('/');
    }

    public function edit(Clientes $cliente)
    {
        $cliente->find(\Auth::user()->Id);
        $cidades = \App\Cidade::all();
        return view('clientes.create-edit', ['cidades' => $cidades]);
    }

    public function update(Request $request, Clientes $cliente)
    {
        $request = $request->except('_token');
        $request['UserId'] = \Auth::user()->id;
        $cliente = $cliente->where('UserId', \Auth::user()->id)->get()[0];

        $cliente->fill($request);
        $cliente->save();
        return redirect('/');
    }
}
