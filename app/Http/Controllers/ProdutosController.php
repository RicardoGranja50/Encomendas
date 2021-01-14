<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutosController extends Controller
{
    //

    public function index(){

        $produtos = Produto::all();

		return view ('produtos.index', [
			'produtos'=>$produtos
		]);
    }

    public function show(Request $r){

        $idProduto = $r->id;

        $produtos = Produto::where('id_produto',$idProduto)->with('encomendas')->first();

		return view('produtos.show',[
			'produtos'=>$produtos
		]);
    }

    public function create(){

         return view('produtos.create');
    }

    public function store(Request $req){

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

    public function edit(Request $req){

        $idProduto=$req->id;
        $produto=Produto::where('id_produto',$idProduto)->first();

        return view('produtos.edit',[
           'produto'=>$produto
        ]);
    }

     public function update(Request $req){

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

    public function destroy(Request $r){
        
        $produto= Produto::where('id_produto', $r->id)->first();

        if(is_null($produto)){

                return redirect()->route('produtos.index')->with('vermelho','O Produto não existe');
            }
            else{

                $produto->delete();
                return redirect()->route('produtos.index')->with('vermelho','Produto eliminado');
            }
    }

    public function mais(){


    }

    public function menos(){

    }
}
