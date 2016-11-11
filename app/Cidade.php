<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table = 'Cidade';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'Id',
        'Cidade',
        'UfId'
    ];
}
