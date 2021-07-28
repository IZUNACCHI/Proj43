<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PropostaProponenteMonitor;


class PropostaProponenteMonitorController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'regime_prestacao_servicos' => 'required',
            'percentagem_prestacao_servicos' => 'required|numeric|min:1',
            'duracao' => 'required',
            'periodo' => 'required',
            'ciclo' => 'required',
            'proposta_proponente_id' => 'required',

            'remuneracao' => 'nullable',
            'escalao' => 'nullable',
            'indice' => 'nullable',
            //'verificacao_outras_uo' => 'required',
        ]);
        $propostaProponenteMonitor = new PropostaProponenteMonitor();
        $propostaProponenteMonitor->fill($request->all());
        $propostaProponenteMonitor->save();
        return response()->json($propostaProponenteMonitor, 200);
    }

     public function update(Request $request, $id)
    {
        $proposta = PropostaProponenteMonitor::findOrFail($id);

        $request->validate([
            'regime_prestacao_servicos' => 'required',
            'percentagem_prestacao_servicos' => 'required|numeric|min:1',
            'duracao' => 'required',
            'periodo' => 'required',
            'ciclo' => 'required',
            'proposta_proponente_id' => 'required',

            
            'remuneracao' => 'nullable',
            'escalao' => 'nullable',
            'indice' => 'nullable',
            //'verificacao_outras_uo' => 'required',
        ]);

        $proposta->fill($request->all());
        $proposta->save();

        return response()->json($proposta, 200);
    }

    public function getProposta($idPropostaProponente)
    {
        return PropostaProponenteMonitor::where('proposta_proponente_id', $idPropostaProponente)->first();
    }

    public function atualizarProposta($propostaProponenteID, Request $request)
    {
        $propostaAAtualizar = PropostaProponenteProfessor::findOrFail($propostaProponenteID);
        $propostaAAtualizar->remuneracao = $request->remuneracao;
        $propostaAAtualizar->escalao = $request->escalao;
        $propostaAAtualizar->indice = $request->indice;
        $propostaAAtualizar->save();
    }
}
