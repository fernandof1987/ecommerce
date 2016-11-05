<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoVendaItens extends Model
{
    protected $primaryKey = 'Id';
    protected $foreignKey = ['ProdutoId', 'PedidoId'];
    protected $table = 'PedidoVendaItens';
    //protected $timestamps = false;
   
    protected $fillable = [
        'Id',
        'PedidoId',
        'ProdutoId',
        'Qtde',
        'ValorVenda',
        'ValorCusto',
        'Desconto',
        'ValorTotal',
        'Peso'
    ];
}
