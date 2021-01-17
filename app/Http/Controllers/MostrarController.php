<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Encomenda;
use Auth;

class MostrarController extends Controller
{
    //

    public function mostrar(Request $r){
       
       	if(auth()->check()){
	        $pesquisa = $r->nome;

	        
	        $clientes = Cliente::where('nome','like','%'.$pesquisa.'%')->with('encomenda')->get();
	        
	        return view('mostrar', [
	            'pesquisa'=>$pesquisa,
	            'clientes'=>$clientes
	        ]);
	    }
	    else{
	    	return view('home');
	    }
    }
}
