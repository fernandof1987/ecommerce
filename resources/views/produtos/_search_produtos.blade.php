<form action='/produtos/busca' method='post' class="form-inline">
    {{ csrf_field() }}
    <h3>Produtos
        <input class="form-control" type="text" name="search" placeholder="Pesquise aqui..." />
        <button class="btn btn-default">Buscar</button>
    </h3>
</form>