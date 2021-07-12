<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropostaDiretorUO extends Model
{
    protected $table = 'proposta_diretor_uo';
    protected $primaryKey = 'id_proposta_diretor_uo';

    protected $fillable = [
        'reconhecimento', 'parecer', 'data_assinatura_uo', 'diretor_uo_id', 'contrato_assinado_uo',
    ];

    protected $hidden = [];
}
