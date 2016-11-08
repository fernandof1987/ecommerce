<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
   
    public $timestamps = false;
    protected $primaryKey = 'Id';
    protected $foreignKey = ['MarcaId', 'CategoriaId'];
    protected $table = 'Produtos';
   
    protected $fillable = [
        'Id',
        'Nome',
        'Descricao',
        'PrecoCusto',
        'PrecoVenda',
        'Peso',
        'ProdutoStatus',
        'MarcaId',
        'CategoriaId',
        'Imagem'
    ];

 
}
