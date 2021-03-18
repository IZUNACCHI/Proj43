<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'curso';
    protected $primaryKey = 'codigo';

    protected $fillable = [
        'codigo', 'nome_curso'
    ];
}
