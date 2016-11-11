@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-2">
            <h3>Categorias</h3>
             @include('produtos._categorias')
        </div>
        <div class="col-md-10 col-md-offset">

            @include('produtos._search_produtos')

            @forelse($produtos as $produto)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="/images/no-image.png" alt="...">
                        <div class="caption">
                            <h3>
                                <a href="/produtos/{{ $produto->Id }}">
                                    {{ $produto->Id }} - 
                                    {{ $produto->Nome }}
                                </a>
                            </h3>
                            <p>R$ {{ $produto->PrecoVenda }}</p>
                            <p>
                                <!--a href="#" class="btn btn-default" role="button">Detalhes</a-->
                            @include('produtos._frm_produto')

                            </p>
                        </div>
                    </div>
                </div>
            @empty
                Não existem produtos cadastrados!
            @endforelse

        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">{{ $produtos->links() }}</div>
    </div>
</div>

@endsection