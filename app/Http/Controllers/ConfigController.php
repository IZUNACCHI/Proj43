<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Config;

class ConfigController extends Controller
{
  public function getConfigPorNome($nome){
	  return DB::table('config')->where('nome_configuracao', $nome)->value('valor');
  }
  
  public function updateConfigPorNome($nome, $valor){
	  $config = Config::where('nome_configuracao', $nome)->first();
	  if($config == null) {
		  DB::table('config')->insert([
			'nome_configuracao' => $nome,
			'valor' => $valor
		  ]);
		  
		  $config = DB::table('config')->where('nome_configuracao', $nome)->get();
		  return $config[0]->id;
	  } else {
		  $config->nome_configuracao = $nome;
		  $config->valor = $valor;
		  $config->save();
		  return response()->json($config, 201);
	  }
	  
  }
  
  public function getConfig(){
	  return Config::all();
  }
}
