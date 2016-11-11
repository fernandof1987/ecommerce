<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoVendas extends Model
{
    protected $primaryKey = 'Id';
    protected $foreignKey = ['UsuarioId'];
    protected $table = 'PedidoVendas';
    //protected $timestamps = false;
   
    protected $fillable = [
        'Id',
        'UsuarioId',
        'QtdeItens',
        'ValorTotal',
        'CustoTotal',
        'PesoTotal',
        'Desconto',
        'DataPedido',
        'PedidoStatus'
    ];
}
