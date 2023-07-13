<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function Teste(int $p1, int $p2) {
       //return view('site.teste', ['p1' => $p1, 'p2' => $p2]); //Array associativo
        return view('site.teste', compact('p1', 'p2')); //Compact
       //return view('site.teste')->with('p1', $p1)->with('p2', $p2); // With Primeiro parametro é o nome da variavel que sera atribuida na viel, o segundo o nome da variavel no contoller
    }
}
