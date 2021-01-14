<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendedor;

class VendedoresController extends Controller
{
    //


    public function index(){

        $vendedores = Vendedor::all();

		return view ('vendedores.index', [
			'vendedores'=>$vendedores
		]);
    }

    public function show(Request $r){

        $idVendedor = $r->id;

        $vendedores = Vendedor::where('id_vendedor',$idVendedor)->first();

		return view('vendedores.show',[
			'vendedores'=>$vendedores
		]);
    }

     public function create(){

        return view('vendedores.create');
        
    }

    public function store(Request $req){

        $novoVendedor=$req->validate([
            'nome'=>['required','min:3','max:100'],
            'especialidade'=>['required','min:3','max:100'],
            'email'=>['required','min:5','max:200']
        ]);

        $vendedor=Vendedor::create($novoVendedor);

        return redirect()->route('vendedores.show',[
            'id'=>$vendedor->id_vendedor
        ])->with('verde','Vendedor Criado');
    }

     public function edit(Request $req){

        $idVendedor=$req->id;
        $vendedor=Vendedor::where('id_vendedor',$idVendedor)->first();

        return view('vendedores.edit',[
           'vendedor'=>$vendedor
        ]);
    }

    public function update(Request $req){

        $idVendedor=$req->id;
        $vendedor=Vendedor::where('id_vendedor',$idVendedor)->first();

        $editarVendedor=$req->validate([
            'nome'=>['required','min:3','max:100'],
            'especialidade'=>['required','min:3','max:100'],
            'email'=>['required','min:5','max:200']
        ]);
        
        $vendedor->update($editarVendedor);

        return redirect()->route('vendedores.show',[
            'id'=>$vendedor->id_vendedor
        ])->with('verde','Vendedor editado');
    }

     public function destroy(Request $r){
        
        $vendedor= Vendedor::where('id_vendedor', $r->id)->first();

        if(is_null($vendedor)){

                return redirect()->route('vendedores.index')->with('vermelho','O vendedor não existe');
            }
            else{

                $vendedor->delete();
                return redirect()->route('vendedores.index')->with('vermelho','Vendedor eliminado');
            }
    }
}
