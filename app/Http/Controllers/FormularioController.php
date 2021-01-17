<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


class FormularioController extends Controller
{
    //

    public function formulario(){
    	if(auth()->check()){
        	return view('formulario');
        }
        else{
        	return view('home');
        }
    }
}
