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
        $relacao= EncomendaProduto::where('id_encomenda',$idEncomenda)->with('produto')->get();
        
        $encomendas = Encomenda::where('id_encomenda',$idEncomenda)->with(['cliente','vendedor','produtos'])->first();
		return view('encomendas.show',[
            'encomendas'=>$encomendas,
            'relacao'=>$relacao
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
       
        $novoProduto['id_encomenda']=$encomenda;
        $produto=EncomendaProduto::create($novoProduto);

        return redirect()->route('encomendas.show',[
            'id'=>$encomenda
        ]);
        
    }

    public function editProduto(Request $req){

        $produtos=Produto::all();
        $idEncomenda=$req->id;
        $idProduto=$req->idp;
        $relacao= EncomendaProduto::where('id_encomenda',$idEncomenda)->where('id_produto',$idProduto)->first();

        return view('encomendas.editProduto',[
           'produtos'=>$produtos,
           'encomenda'=>$idEncomenda,
           'relacao'=>$relacao
        ]);

    }

    public function updateProduto(Request $req){
        
        $idEncomenda=$req->id;
        $idProduto=$req->idp;
        $novo= EncomendaProduto::where('id_encomenda',$idEncomenda)->where('id_produto',$idProduto)->first();

        $editarProduto=$req->validate([
            'id_produto'=>['numeric','required'],
            'preco'=>['required','min:1','max:3'],
            'quantidade'=>['required','min:1','max:200']
        ]);
       
        $editarProduto['id_encomenda']=$idEncomenda;
        $novo->update($editarProduto);


        return redirect()->route('encomendas.show',[
            'id'=>$idEncomenda
        ]);

    }

    public function destroy(Request $req){

        $idEncomenda=$req->id;
        $idProduto=$req->idp;
        $eliminar= EncomendaProduto::where('id_encomenda',$idEncomenda)->where('id_produto',$idProduto)->first();

        if(is_null($eliminar)){

            return redirect()->route('encomendas.show',['id'=>$idEncomenda])->with('vermelho','O produto não existe');
        }
        else{

            $eliminar->delete();
            return redirect()->route('encomendas.show',['id'=>$idEncomenda])->with('vermelho','Produto eliminado');
        }
    }
}
