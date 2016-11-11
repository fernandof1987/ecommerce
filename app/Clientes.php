<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'Clientes';
    protected $primaryKey = 'Id';
    public $timestamps = false;
    protected $fillable = [
        'Id',
        'UserId',
        'Nome',
        'CPF',
        'CidadeId',
        'CEP',
        'Endereco'
    ];
}
