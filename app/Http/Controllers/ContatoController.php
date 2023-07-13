<?php

namespace App\Http\Controllers;

use App\SiteContato;
use Illuminate\Http\Request;
use App\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request){

        $motivo_contatos = MotivoContato::all();
        
        // $contato = new SiteContato();
        // $contato->nome = $request->input('nome');
        // $contato->telefone = $request->input('telefone');
        // $contato->email = $request->input('email');
        // $contato->motivo_contato = $request->input('motivo_contato');
        // $contato->mensagem = $request->input('mensagem');
        // $contato->save();

        //Metodo Fill (precisa deficinir varavel fillable na classe)
        // $contato = new SiteContato();
        // $contato->fill($request->all());
        // $contato->save();

        //Metodo Create(precisa definir vareavel fillable na classe)
        // $contato = new SiteContato();
        // $contato->create($request->all());

        return view('site.contato', ['titulo' => 'Contato (teste)', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request){
        //realizar a validação dos dados recebidos do formulario    
        $regras = [
            'nome' => 'required|min:3|max:40',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000'
        ];
        
        $feedback =  [
            
            'nome.min' => 'O campo nome precisa ter no minimo 3 caracteres',
            'nome.max' => 'O campo nome precisa ter no maximo 40 caracteres',
            'email.email' => 'O campo email precisa de um valor valido',
            'motivo_contato.id' => 'O campo motivo contato precisa ser preenchido',
            'mensagem.max' => 'O campo mensagem precisa ter no maximo 2000 caracteres',

            //Mensagem generica para erro de campo obrigatorio, caso exista um personalizado tera prioridade para aparecer sobre o generico
            'required' => 'O campo :attribute deve ser preenchido'
        ];

        $request->validate($regras,$feedback);
        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}
