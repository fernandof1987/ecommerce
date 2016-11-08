<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    protected $primaryKey = 'Id';
    protected $table = 'Marcas';
    public $timestamps  = false;
    protected $fillable = [
        'Id',
        'Nome'
    ];
}
