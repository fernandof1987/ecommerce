<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $table = 'Produtos';
   
    protected $fillable = [
        'Id',
        'Descicao',
        'PrecoCusto',
        'PrecoVenda',
        'Peso',
        'ProdutoStatus',
    ];
}
