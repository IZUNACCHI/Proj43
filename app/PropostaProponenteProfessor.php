<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropostaProponenteProfessor extends Model
{

    protected $table = 'proposta_proponente_professor';
    protected $primaryKey = 'id_proposta_proponente_professor';

    protected $fillable = [
        'role_professor', 'tipo_contrato', 'regime_prestacao_servicos','percentagem_prestacao_servicos_2',
        'fundamentacao', 'percentagem_prestacao_servicos', 'periodo', 'duracao', 'descricao', 'remuneracao', 'escalao', 'indice',
        'verificacao_outras_uo', 'nome_uo', 'tempo_parcial_uo', 'periodo_uo',
        'avaliacao_periodo_anterior', 'proposta_proponente_id' 
    ];

    protected $hidden = [];
}
