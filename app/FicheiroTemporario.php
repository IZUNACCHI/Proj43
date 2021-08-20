<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FicheiroTemporario extends Model
{
    protected $table='ficheiro_temporario';

    public $timestamps = false;

    protected $fillable=[
        'nome', 'descricao'
    ];
}
