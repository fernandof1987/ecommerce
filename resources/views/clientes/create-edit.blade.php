@extends('layouts.app')

@section('content')

<div class="col-md-10 col-md-offset-1">
    <?php
        $cliente = \App\Clientes::where('UserId', \Auth::user()->id)->get();
        //$cliente = isset(\App\Clientes::where('UserId', \Auth::user()->id)->get()[0]);
    ?>
    @if(!empty($cliente[0]))
        <?php $cliente = $cliente[0] ?>
        <form action="/cliente/update" method="post" class="form">
            {{ csrf_field() }}

            <input type="text"   name="Nome"       value="{{ $cliente->Nome }}" class="form-control" placeholder="Nome"><br />
            <input type="text"   name="CPF"        value="{{ $cliente->CPF }}" class="form-control" placeholder="CPF"><br />
            <input type="text"   name="CEP"        value="{{ $cliente->CEP }}" class="form-control" placeholder="CEP"><br />
            <input type="text"   name="Endereco"   value="{{ $cliente->Endereco }}" class="form-control" placeholder="Endereco"><br />

            <select name="CidadeId" class="form-control">
                @foreach($cidades as $cidade)
                        <option value="{{ $cidade->Id }}">{{ $cidade->Cidade }}</option>
                @endforeach
            </select><br />

            <button class="btn btn-primary">Ok</button>
        </form>
    @else
        <form action="/cliente/store" method="post" class="form">
            {{ csrf_field() }}

            <input type="text"   name="Nome"       class="form-control" placeholder="Nome"><br />
            <input type="text"   name="CPF"        class="form-control" placeholder="CPF"><br />
            <input type="text"   name="CEP"        class="form-control" placeholder="CEP"><br />
            <input type="text"   name="Endereco"   class="form-control" placeholder="Endereco"><br />

            <select name="CidadeId" class="form-control">
                @foreach($cidades as $cidade)
                        <option value="{{ $cidade->Id }}">{{ $cidade->Cidade }}</option>
                @endforeach
            </select><br />

            <button class="btn btn-primary">Ok</button>
        </form>
    @endif

    

</div>

@endsection