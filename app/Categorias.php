<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $primaryKey = 'Id';
    protected $table = 'Categorias';
    public $timestamps  = false;
    protected $fillable = [
        'Id',
        'Nome'
    ];
}
