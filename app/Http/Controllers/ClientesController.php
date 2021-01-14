<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Encomenda;

class ClientesController extends Controller
{
    //
    public function principal(){

        return view('clientes.principal');

    }

    public function index(){

        $clientes = Cliente::all();

		return view ('clientes.index', [
			'clientes'=>$clientes
		]);
    }

    public function show(Request $r){

        $idCliente = $r->id;

        $clientes = Cliente::where('id_cliente',$idCliente)->with('encomenda')->first();

		return view('clientes.show',[
			'clientes'=>$clientes
		]);
    }

    public function create(){

        return view('clientes.create');
        
    }

    public function store(Request $req){

        $novoCliente=$req->validate([
            'nome'=>['required','min:3','max:100'],
            'morada'=>['required','min:5','max:100'],
            'telefone'=>['required','min:9','max:13'],
            'email'=>['required','min:5','max:200']
        ]);

        $cliente=Cliente::create($novoCliente);

        return redirect()->route('clientes.show',[
            'id'=>$cliente->id_cliente
        ])->with('verde','Cliente Criado');
    }

    public function edit(Request $req){

        $idCliente=$req->id;
        $cliente=Cliente::where('id_cliente',$idCliente)->first();

        return view('clientes.edit',[
           'cliente'=>$cliente
        ]);
    }

    public function update(Request $req){

        $idCliente=$req->id;
        $cliente=Cliente::where('id_cliente',$idCliente)->first();

        $editarCliente=$req->validate([
            'nome'=>['required','min:3','max:100'],
            'morada'=>['required','min:5','max:100'],
            'telefone'=>['required','min:9','max:13'],
            'email'=>['required','min:5','max:200']
        ]);
        
        $cliente->update($editarCliente);

        return redirect()->route('clientes.show',[
            'id'=>$cliente->id_cliente
        ])->with('verde','Cliente editado');
    }

    public function destroy(Request $r){
        
        $cliente= Cliente::where('id_cliente', $r->id)->first();

        if(is_null($cliente)){

                return redirect()->route('clientes.index')->with('vermelho','O cliente não existe');
            }
            else{

                $cliente->delete();
                return redirect()->route('clientes.index')->with('vermelho','Cliente eliminado');
            }
    }
}
