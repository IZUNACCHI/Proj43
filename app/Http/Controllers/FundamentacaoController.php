<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fundamentacao;
use Illuminate\Support\Facades\Auth;

class FundamentacaoController extends Controller
{
    public function getFundamentacoes($user_id){
		
		return Fundamentacao::where('user_id', $user_id)->get();
	}
	
	public function deleteFundamentacao($id){
		$fundamentacao = Fundamentacao::where('id', $id)->delete();
		return $fundamentacao;
	}
	
	public function create(Request $request){
		$fundamentacao = Fundamentacao::create([
		'fundamentacao' => $request->fundamentacao,
		'user_id' => $request->user_id
		]);
		
		 return response()->json($fundamentacao, 200);
	}
	
	
	
}
