<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropostaRecursosHumanos extends Model
{

    protected $table='proposta_recursos_humanos';
    protected $primaryKey = 'id_proposta_recursos_humanos';

    protected $fillable = [
         'numero_funcionario', 'contratacao_comunicada',
        'inscricao', 'despacho_presidente_ipl', 'contrato_redigido', 'contrato_anexo', 
        'cessacao_social', 'NISS_ou_numero_CGA', 'data_nascimento', 'numero_CC',
        'dados_GIAF_carregados_por', 'data_carregamento_dados_GIAF', 'recursos_humanos_id'
    ];

    protected $hidden = [];
}
