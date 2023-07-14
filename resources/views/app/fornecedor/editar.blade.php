@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Fornecedor - Editar</p>
        </div>
        <div class="menu">
            <ul>
                <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">consulta</a></li>
            </ul>
        </div>
        <div class="informacao-pagina">
         <form method="post" action="{{ route('app.fornecedor.editar') }}">
                    @csrf
                    <input type="text" name="nome" value = "{{ $fornecedor->nome }}" placeholder="Nome 2" class="borda-presta">
                    {{ $errors->has(["nome"]) ? $errors->first() : '' }}

                    <input type="text" name="site" value = "{{ $fornecedor->site }}" placeholder="Site"class="borda-presta">
                    {{ $errors->has(["site"]) ? $errors->first() : '' }}

                    <input type="text" name="uf" value = "{{ $fornecedor->uf }}" placeholder="UF"class="borda-presta">
                    {{ $errors->has(["uf"]) ? $errors->first() : '' }}

                    <input type="text" name="email" value = "{{ $fornecedor->email }}" placeholder="E-mail"class="borda-presta">
                    {{ $errors->has(["email"]) ? $errors->first() : '' }}

                    <button type="submit" class="borda-preta">Cadastrar</button>
                </form>
            
        </div>
    </div>
    
@endsection