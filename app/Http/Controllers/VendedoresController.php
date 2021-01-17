<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendedor;
use Auth;
use Illuminate\Support\Facades\Gate;

class VendedoresController extends Controller
{
    //


    public function index(){

        if(auth()->check()){
            $vendedores = Vendedor::all();

    		return view ('vendedores.index', [
    			'vendedores'=>$vendedores
    		]);
        }
        else{
            return view('home');
        }
    }

    public function show(Request $r){

        if(auth()->check()){
            $idVendedor = $r->id;

            $vendedores = Vendedor::where('id_vendedor',$idVendedor)->first();

    		return view('vendedores.show',[
    			'vendedores'=>$vendedores
    		]);
        }
        else{
            return view('home');
        }
    }

     public function create(){

        if(auth()->check()){
            if(Gate::allows('admin')){
                return view('vendedores.create');
            }
            else{
                return redirect()->route('vendedores.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }
        
    }

    public function store(Request $req){

        if(auth()->check()){

            if(Gate::allows('admin')){
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
            else{
                 return redirect()->route('vendedores.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }
    }

     public function edit(Request $req){

        if(auth()->check()){
            if(Gate::allows('admin')){
                $idVendedor=$req->id;
                $vendedor=Vendedor::where('id_vendedor',$idVendedor)->first();

                return view('vendedores.edit',[
                   'vendedor'=>$vendedor
                ]);
            }
            else{
                return redirect()->route('vendedores.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }
    }

    public function update(Request $req){

        if(auth()->check()){
            if(Gate::allows('admin')){
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
            else{
                return redirect()->route('vendedores.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }
    }

     public function destroy(Request $r){
        
        if(auth()->check()){
            if(Gate::allows('admin')){
                $vendedor= Vendedor::where('id_vendedor', $r->id)->first();

                if(is_null($vendedor)){

                        return redirect()->route('vendedores.index')->with('vermelho','O vendedor não existe');
                    }
                    else{

                        $vendedor->delete();
                        return redirect()->route('vendedores.index')->with('vermelho','Vendedor eliminado');
                    }
            }
            else{
                 return redirect()->route('vendedores.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }
    }
}
