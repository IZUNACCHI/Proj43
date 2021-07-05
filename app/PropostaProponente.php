<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropostaProponente extends Model
{

    protected $table = 'proposta_proponente';
    protected $primaryKey = 'id_proposta_proponente';

    protected $fillable = [
        'unidade_organica', 'nome_completo', 'email', 'numero_telefone', 'data_de_assinatura_coordenador_departamento', 'tipo_contrato',
        'data_de_assinatura_coordenador_de_curso', 'fundamentacao_coordenador_curso',
        'fundamentacao_coordenador_departamento', 'grau', 'verificacao_curso', 'verificacao_area_cientifica', 'primeiro_proponente',
        'segundo_proponente', 'role', 'departamento_curso', 'formacao', 'remuneracao', 'escalao', 'indice',
        'verificacao_outras_uo', 'nome_uo', 'tempo_parcial_uo', 'periodo_uo','curso_Doutoramento','curso_Outro',
		'curso_Formacao','area_cientificaDoutoramento','area_cientificaOutro','area_cientificaFormacao','verificacao_serviço_docente_atribuido',
        'verificacao_tempo_parcial',
        
    ];

    protected $hidden = [];
}
