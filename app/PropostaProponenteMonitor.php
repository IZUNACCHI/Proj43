<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropostaProponenteMonitor extends Model
{

    protected $table = 'proposta_proponente_monitor';
    protected $primaryKey = 'id_proposta_proponente_monitor';

    protected $fillable = [
        'regime_prestacao_servicos', 'percentagem_prestacao_servicos', 'periodo',
        'descricao', 'remuneracao', 'escalao', 'indice',
        'verificacao_outras_uo', 'nome_uo', 'tempo_parcial_uo', 'periodo_uo',
        'duracao', 'ciclo', 'proposta_proponente_id'
    ];

    protected $hidden = [

    ];
}
