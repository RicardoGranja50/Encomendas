<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encomenda;
use App\Models\Cliente;
use App\Models\Vendedor;
use App\Models\Produto;
use App\Models\EncomendaProduto;
use Auth;
use Illuminate\Support\Facades\Gate;


class EncomendasController extends Controller
{
    //
    public function index(){

        if(auth()->check()){
            $encomendas = Encomenda::where('id_encomenda', '>','0')->with('cliente')->get();
           
    		return view ('encomendas.index', [
    			'encomendas'=>$encomendas
    		]);
        }
        else{
            return view('home');
        }
    }

    public function show(Request $r){

        if(auth()->check()){
            $idEncomenda = $r->id;
            $relacao= EncomendaProduto::where('id_encomenda',$idEncomenda)->with('produto')->get();
            
            $encomendas = Encomenda::where('id_encomenda',$idEncomenda)->with(['cliente','vendedor','produtos'])->first();
    		return view('encomendas.show',[
                'encomendas'=>$encomendas,
                'relacao'=>$relacao
    		]);
        }
        else{
            return view('home');
        }
    }

    public function create(){

        if(auth()->check()){
            $clientes=Cliente::all();
            $produtos=Produto::all();
            $vendedores=Vendedor::all();
            if(Gate::allows('admin')){
                return view('encomendas.create',[
                    'clientes'=>$clientes,
                    'produtos'=>$produtos,
                    'vendedores'=>$vendedores
                ]);
            }
            else{
                 return redirect()->route('encomendas.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }
    }

    public function store(Request $req){
        
        if(auth()->check()){
            if(Gate::allows('admin')){
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
            else{
                 return redirect()->route('encomendas.index')->with('vermelho','Nao tem permissao');
            }  
        }      
        else{
            return view('home');
        }
    }
    

    public function createProduto(Request $req){

        if(auth()->check()){

            if(Gate::allows('admin')){
                $produtos=Produto::all();
                $encomenda=$req->id;
                

                return view('encomendas.createProduto',[
                    'produtos'=>$produtos,
                    'encomenda'=>$encomenda
                ]);
            }
            else{
                return redirect()->route('encomendas.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return route('home');
        }
            
    }

    public function storeProduto(Request $req){

         if(auth()->check()){

            if(Gate::allows('admin')){
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
            else{
                return redirect()->route('encomendas.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }
    }

    public function editProduto(Request $req){

         if(auth()->check()){

            if(Gate::allows('admin')){
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
            else{
                 return redirect()->route('encomendas.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }

    }

    public function updateProduto(Request $req){
        
         if(auth()->check()){

            if(Gate::allows('admin')){
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
                ])->with('verde','Produto editado');
            }
            else{
                return redirect()->route('encomendas.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }

    }

    public function destroyProduto(Request $req){

         if(auth()->check()){

            if(Gate::allows('admin')){
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
            else{
                return redirect()->route('encomendas.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }
    }

    public function destroy(Request $req){

        if(auth()->check()){

            if(Gate::allows('admin')){
                $idEncomenda=$req->id;
                $eliminar= EncomendaProduto::where('id_encomenda',$idEncomenda)->get();
                $eliminar2= Encomenda::where('id_encomenda',$idEncomenda)->first();
                if(is_null($eliminar)){

                    return redirect()->route('encomendas.show',['id'=>$idEncomenda])->with('vermelho','A encomenda não existe');
                }
                else{
                    foreach($eliminar as $delete){
                        $delete->delete();
                    }
                    
                    $eliminar2->delete();
                    return redirect()->route('encomendas.index')->with('vermelho','Encomenda eliminado');
                }
            }
            else{
                 return redirect()->route('encomendas.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return view('home');
        }
    }
}
