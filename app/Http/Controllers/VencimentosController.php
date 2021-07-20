<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vencimentos;
use Illuminate\Support\Facades\Auth;

class VencimentosController extends Controller
{
    public function getVencimentos(){
		
		//return Vencimentos::where('user_id', $user_id)->get();
        return Vencimentos::all();
	}


	public function deleteVencimetos($id){
		$vencimentos = Vencimentos::where('id', $id)->delete();
		return $vencimentos;
	}
	
	public function create(Request $request){
		$vencimentos = Vencimentos::create([
		'renumeracao' => $request->renumeracao,
        'descricao' => $request->descricao,
		'indice' => $request->indice,
		'escalao' => $request->escalao,
		'user_id' => $request->user_id
		]);
		
		 return response()->json($vencimentos, 200);
	}
	
	
	public function getBlocked($id){
        //dd($id);
        $vencimentos = Vencimentos::where('id', $id)->delete();
        return response()->json([$vencimentos, 200]);
    }

    public function updateRenumeracao(Request $request, $id)
    {
        $user = Vencimentos::where('id', $id)->first();
        $user->renumeracao = $request->getContent();
        $user->save();

        return response()->json($user, 200);
    }

    public function verificarSeJaExistemCategoriaVencimento($descricao){
        //dd($email);
        $descricaoVencimento = DB::table('vencimentos')->where('descricao', $descricao)->get();
        
        if(!$descricaoVencimento->isEmpty()){
            foreach($descricaoVencimento as $p){
                //dd($proposta->id_proposta_proponente);
                $proposta = DB::table('vencimentos')->join('vencimentos', 'vencimentos.id')->where('vencimentos.id', $p->id)->
          
                var_dump($proposta);
                if(!$proposta->isEmpty()){
                    return response()->json(true);//Nao avanca
                }
            }
        }
        return response()->json(false); //Avanca
    }
}
