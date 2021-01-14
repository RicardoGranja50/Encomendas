<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encomenda;
use App\Models\Cliente;
use App\Models\Vendedor;
use App\Models\Produto;
use App\Models\EncomendaProduto;


class EncomendasController extends Controller
{
    //
    public function index(){

        $encomendas = Encomenda::where('id_encomenda', '>','0')->with('cliente')->get();
       
		return view ('encomendas.index', [
			'encomendas'=>$encomendas
		]);
    }

    public function show(Request $r){

        $idEncomenda = $r->id;
        $encomendas = Encomenda::where('id_encomenda',$idEncomenda)->with(['cliente','vendedor','produtos'])->first();
		return view('encomendas.show',[
			'encomendas'=>$encomendas
		]);
    }

    public function create(){

        $clientes=Cliente::all();
        $produtos=Produto::all();
        $vendedores=Vendedor::all();

        return view('encomendas.create',[
            'clientes'=>$clientes,
            'produtos'=>$produtos,
            'vendedores'=>$vendedores
        ]);
        
    }

    public function store(Request $req){
        
        $novaEncomenda=$req->validate([
            'id_cliente'=>['numeric','required'],
            'id_vendedor'=>['numeric','required'],
            'data'=>['required','date'],
            'observacoes'=>['nullable','min:10','max:200']
        ]);
        
        
        $encomenda=Encomenda::create($novaEncomenda);
        

        return redirect()->route('encomendas.index',[
            'id'=>$encomenda->id_encomenda,
        ]);

    }

    public function createProduto(Request $req){

        $produtos=Produto::all();
        $encomenda=$req->id;

        return view('encomendas.createProduto',[
            'produtos'=>$produtos,
            'encomenda'=>$encomenda
        ]);
        
    }

    public function storeProduto(Request $req){

        $encomenda=$req->id;
        $novoProduto=$req->validate([
            'id_produto'=>['numeric','required'],
            'preco'=>['required','min:1','max:3'],
            'quantidade'=>['required','min:1','max:200']
        ]);
            ///fiquei aqui (perguntar na proxima aula sobre add id encomenda)
        $produto=EncomendaProduto::create($novoProduto);
        $produto->encomenda()->attach($encomenda);

        return redirect()->route('encomendas.show',[
            'id'=>$encomenda
        ]);
        
    }
}
