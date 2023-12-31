<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index(){
        return view ('app.fornecedor.index');
    }

    public function listar(Request $request){

        $fornecedores = Fornecedor::where('nome', 'like', '%'.$request->input('nome').'%')
                                  ->where('site', 'like', '%'.$request->input('site').'%')
                                  ->where('uf', 'like', '%'.$request->input('uf').'%')
                                  ->where('email', 'like', '%'.$request->input('email').'%')
                                  ->paginate(2);


        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request){
        
        $msg = '';

        if($request->input('_token') != '' && $request->input('id') == ''){
            //Validação dos dados
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'uf.min' => 'O campo UF deve ter no mínimo 2 caracteres',
                'uf.max' => 'O campo UF deve ter no máximo 2 caracteres',
                'email' => 'O campo E-mail não foi preenchido corretamente'
            ];



            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            //Poderia dar um redirect para uma view de sucesso

            //enviar dados para a view
            $msg = 'Cadastro Realizado com sucesso!';

        } 

        if($request->input('_token') != '' && $request->input('id') != ''){
            //edição
            $fornecedor = Fornecedor::find($request->input('id'));

            $update = $fornecedor->update($request->all());

            if($update){
                $msg = 'Atualização Realizado com sucesso!';
            } else {
                $msg = 'Erro ao tentar atualizar o registro!';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);

        }
        
        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function Editar($id, $msg = ''){
        //Recupero o fornecedor apartir do ID
        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function Excluir($id){
        Fornecedor::find($id)->delete();

        return redirect()->route('app.fornecedor');
    }

}
