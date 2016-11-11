@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-2">
            <h3>Categorias</h3>
             @include('produtos._categorias')
        </div>
        <div class="col-md-10 col-md-offset">
            <h3>{{ $produto->Id }} - {{ $produto->Nome }}</h3>
            <img src="{{ $produto->Imagem or '/images/no-image.png' }}"/>
            <h4>Descrição</h4>
            <p>{{ $produto->Descricao }}</p>
            Peso: {{ $produto->Peso }} <br />
            Valor: {{ $produto->PrecoVenda }}

            @include('produtos._frm_produto')

        </div>
    </div>
</div>

@endsection