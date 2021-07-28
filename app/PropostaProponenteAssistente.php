<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropostaProponenteAssistente extends Model
{

    protected $table='proposta_proponente_assistente';
    protected $primaryKey = 'id_proposta_proponente_assistente';

    protected $fillable =[
        'regime_prestacao_servicos', 'percentagem_prestacao_servicos', 'percentagem_prestacao_servicos_2',
        'descricao', 'remuneracao', 'escalao', 'indice',
        'verificacao_outras_uo', 'nome_uo', 'tempo_parcial_uo', 'periodo_uo',
        'fundamentacao', 'periodo', 'duracao', 'avaliacao_periodo_anterior', 'proposta_proponente_id'
    ];

    protected $hidden = [

    ];
}
