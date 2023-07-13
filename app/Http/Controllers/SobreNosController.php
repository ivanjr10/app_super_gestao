<?php

namespace App\Http\Controllers;

class SobreNosController extends Controller
{
    //Caso adicionar middleware pelo controller
    // public function __construct()
    // {
    //     $this->middleware(LogAcessoMiddleware::class);
    // }
    public function sobreNos(){
        return view('site.sobre-nos');
    }
}
