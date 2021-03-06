<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use Auth;
use Illuminate\Support\Facades\Gate;

class ProdutosController extends Controller
{
    //

    public function index(){

        if(auth()->check()){
            $produtos = Produto::all();

    		return view ('produtos.index', [
    			'produtos'=>$produtos
    		]);
        }
        else{
            return view('home');
        }
    }

    public function show(Request $r){

        if(auth()->check()){
            $idProduto = $r->id;

            $produtos = Produto::where('id_produto',$idProduto)->with('encomendas')->first();

    		return view('produtos.show',[
    			'produtos'=>$produtos
    		]);
        }
        else{
            return view('home');
        }
    }

    public function create(){
        if(auth()->check()){
            if(Gate::allows('admin')){
                return view('produtos.create');
            }
            else{
                 return redirect()->route('produtos.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }
    }

    public function store(Request $req){
        if(auth()->check()){

            if(Gate::allows('admin')){
                $novoProduto=$req->validate([
                    'designacao'=>['required','min:3','max:100'],
                    'preco'=>['required','min:1','max:100'],
                    'stock'=>['required','min:1','max:13'],
                    'observacoes'=>['nullable','min:5','max:200']
                ]);

                $produto=Produto::create($novoProduto);

                return redirect()->route('produtos.show',[
                    'id'=>$produto->id_produto
                ])->with('verde','Produto Criado');
            }
            else{
                return redirect()->route('produtos.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }
    }

    public function edit(Request $req){

        if(auth()->check()){

            if(Gate::allows('admin')){
                $idProduto=$req->id;
                $produto=Produto::where('id_produto',$idProduto)->first();

                return view('produtos.edit',[
                   'produto'=>$produto
                ]);
            }
            else{
                 return redirect()->route('produtos.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }
    }

     public function update(Request $req){

        if(auth()->check()){

            if(Gate::allows('admin')){
                $idProduto=$req->id;
                $produto=Produto::where('id_produto',$idProduto)->first();

                $editarProduto=$req->validate([
                    'designacao'=>['required','min:3','max:100'],
                    'preco'=>['required','min:1','max:100'],
                    'stock'=>['required','min:1','max:100'],
                    'observacoes'=>['nullable','min:5','max:200']
                ]);
                
                $produto->update($editarProduto);

                return redirect()->route('produtos.show',[
                    'id'=>$produto->id_produto
                ])->with('verde','Produto editado');
            }
            else{
                return redirect()->route('produtos.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }
    }

    public function destroy(Request $r){
        
        if(auth()->check()){

            if(Gate::allows('admin')){
                $produto= Produto::where('id_produto', $r->id)->first();

                if(is_null($produto)){

                        return redirect()->route('produtos.index')->with('vermelho','O Produto não existe');
                    }
                    else{

                        $produto->delete();
                        return redirect()->route('produtos.index')->with('vermelho','Produto eliminado');
                    }
            }
            else{
                return redirect()->route('produtos.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }
    }

    public function mais(Request $req){

        if(auth()->check()){

            if(Gate::allows('admin')){
                $idProduto=$req->id;
                $produto=Produto::where('id_produto',$idProduto)->first();
                $prd['stock']=$produto->stock+1;
                $produto->update($prd);

                return redirect()->route('produtos.show',[
                    'id'=>$idProduto
                ]);
            }
            else{
                return redirect()->route('produtos.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }
        
    }

    public function menos(Request $req){

        if(auth()->check()){

            if(Gate::allows('admin')){
                $idProduto=$req->id;
                $produto=Produto::where('id_produto',$idProduto)->first();
                $prd['stock']=$produto->stock-1;
                $produto->update($prd);

                return redirect()->route('produtos.show',[
                    'id'=>$idProduto
                ]);
            }
            else{
                 return redirect()->route('produtos.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }
    }
}
