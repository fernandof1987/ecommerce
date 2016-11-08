@inject('categorias',  'App\Categorias')

<ul class="list-group">
    <a href="/produtos"><li class="list-group-item">Todos</li></a>
    @foreach($categorias::all() as $categoria)    
       <a href="/produtos/categoria/{{ $categoria->Id }}"><li class="list-group-item">{{ $categoria->Nome }}</li></a>
    @endforeach
</ul>
