<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PropostaProponenteAssistente;

class PropostaProponenteAssistenteController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'regime_prestacao_servicos' => 'required',
            'percentagem_prestacao_servicos' => 'nullable|numeric|min:1',
            'percentagem_prestacao_servicos_2' => 'nullable|numeric|min:1',
            'duracao' => 'required',
            'periodo' => 'required',
            'avaliacao_periodo_anterior' => 'nullable',
            'proposta_proponente_id' => 'required',

            'remuneracao' => 'nullable',
            'escalao' => 'nullable',
            'indice' => 'nullable',
            'verificacao_outras_uo' => 'required',
        ]);
        $propostaProponenteAssistente = new PropostaProponenteAssistente();
        $propostaProponenteAssistente->fill($request->all());
        $propostaProponenteAssistente->save();
        return response()->json($propostaProponenteAssistente, 200);
    }

    public function update(Request $request, $id)
    {
        $proposta = PropostaProponenteAssistente::findOrFail($id);

        $request->validate([
            'regime_prestacao_servicos' => 'required',
            'percentagem_prestacao_servicos' => 'nullable|numeric|min:1',
            'percentagem_prestacao_servicos_2' => 'nullable|numeric|min:1',
            'duracao' => 'required',
            'periodo' => 'required',
            'avaliacao_periodo_anterior' => 'nullable',
            'proposta_proponente_id' => 'required',

            'remuneracao' => 'nullable',
            'escalao' => 'nullable',
            'indice' => 'nullable',
            'verificacao_outras_uo' => 'required',
        ]);

        $proposta->fill($request->all());
        $proposta->save();

        return response()->json($proposta, 200);
    }

    public function getProposta($idPropostaProponente)
    {
        return PropostaProponenteAssistente::where('proposta_proponente_id', $idPropostaProponente)->first();
    }

    public function atualizarProposta($propostaProponenteID, Request $request)
    {
        $propostaAAtualizar = PropostaProponenteAssistente::findOrFail($propostaProponenteID);
        $propostaAAtualizar->remuneracao = $request->remuneracao;
        $propostaAAtualizar->escalao = $request->escalao;
        $propostaAAtualizar->indice = $request->indice;
        $propostaAAtualizar->save();
    }
}
