<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstoqueEntrada extends Model
{
    protected $primaryKey = 'Id';
    protected $table = 'EstoqueEntrada';
    public $timestamps = false;
    protected $fillable = [
        'Id',
        'ProdutoId',
        'DataEntrada',
        'QtdeAnterior',
        'QtdeEntrada',
        'QtdeRestante',
        'UsuarioId',
        'PedidoCompraId',
        'Obs'
    ];
}
