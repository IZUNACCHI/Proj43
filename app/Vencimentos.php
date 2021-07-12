<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vencimentos extends Model
{
    protected $table = 'vencimentos';

    protected $fillable = [
        'id',
        'descricao',
        'renumeracao',
		'escalao',
		'indice',
    ];

    /*
    public function criarVencimentos(Request $request){
        $vencimento = Vencimentos::where('descricao', $request->descricao)->get();
        if(!$vencimento->isEmpty()){
            return response()->json("Já existe um vencimento com essa descricao", 401);
        }

        $request->validate([
            'renumeracao' => 'required|numeric',
            'escalao' => 'required'
            'indice' => 'required'
        ]);

        $cursoAInserir = new Vencimentos();
        $cursoAInserir->fill($request->all());
        $cursoAInserir->save();
        return response()->json($cursoAInserir, 200);
    }

    public function getVencimento($codigo_curso)
    {
        return Curso::where('codigo', $codigo_curso)->first()->nome_curso;
    }*/

}
