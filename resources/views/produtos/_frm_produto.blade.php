<?php
    use App\Estoque;
?>
<form method="Post" action="/pedido/itens/add" class="form-inline">
    {{ csrf_field() }}
    <div class="form-group">
        <div class="input-group">
            <!-- Input Hiddens -->
            <input type="hidden" name="ProdutoId" value="{{ $produto->Id }}" />
            <input type="hidden" name="PrecoVenda" value="{{ $produto->PrecoVenda }}" />
            <input type="hidden" name="PrecoCusto" value="{{ $produto->PrecoCusto }}" />
            <input type="hidden" name="Peso" value="{{ $produto->Peso }}" />
            
        </div>
    </div>

    <?php
        $estoque = Estoque::where('ProdutoId', $produto->Id)->get(['Qtde']);
        $estoque = !empty($estoque[0]->Qtde) ? 1 : NULL;
    ?>

    @if($estoque)
        <input type="text" name="Qtde" value="1" maxlength="3" min="1" pattern="[1-9]+$]" size="3" class="form-control" required/>
        <button class="btn btn-primary" role="button">Adicionar</button>
    @else
        <a href="" class="btn btn-danger disabled" role="button">Indisponivel</a>
    @endif
</form>