<?php

namespace App\Http\Controllers;

use App\FicheiroTemporario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FicheiroTemporarioController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->file('file');

        $request->validate([
            'file' => 'required|file|mimes:pdf',
            'descricao' => 'required',
            //'proposta_id' => 'required',
        ]);

        $name = $request->descricao . '.' . $file->getClientOriginalExtension();

        /*$ficheiro = new FicheiroTemporario();
        $ficheiro->nome = $name;
        $ficheiro->descricao = $request->descricao;
        //$ficheiro->proposta_id = '1';
        $ficheiro->save();*/

        //* Guardar o ficheiro localmente na pasta ficheiros
        if ($file->isValid()) {
            Storage::disk('local')->putFileAs('public/ficheiros/temporario', $file, $name);
        }

        return response()->json("Ficheiro Introduzido com sucesso|", 200);
    }
    
    public function deleteFicheirosTemporarios()
    {
        //? Apagar todos os ficheiros
        
        $id = "Ficheiro Unidades Curriculares do docente a ser contratado";
        //Ficheiro::where('descricao', $id)->delete();
        Storage::disk('local')->deleteDirectory('public/ficheiros/temporario');

        return response()->json('Ficheiros apagados com sucesso!', 200); 
    }

    /*
    public function downloadFicheiroTemporario($proposta_id, $descricao)
    {
        $ficheiro = Ficheiro::where('proposta_id', $proposta_id)->where('descricao', $descricao)->first();
        $file = new File(storage_path('app/' . 'public/ficheiros/' . $proposta_id . '/' . $ficheiro->nome));


        return response()->download(
            storage_path('app/' . 'public/ficheiros/' . $proposta_id . '/' . $ficheiro->nome),
            $ficheiro->nome);
    }

    public function getFicheirosTemporarios($proposta_id)
    {
        return Ficheiro::where('proposta_id', $proposta_id)->get();
    }*/
}
