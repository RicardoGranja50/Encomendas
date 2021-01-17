<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Encomenda;
use Mail;
use App\Mail\Notificacao;
use Illuminate\Support\Facades\Storage;
use Auth;
use Illuminate\Support\Facades\Gate;

class ClientesController extends Controller
{
    //
    public function principal(){

        if(auth()->check()){
            return view('clientes.principal');
        }
        else{
            return view('home');
        }

        

    }

    public function email(){

        if(auth()->check()){
            $clientes=Cliente::all();
            Mail::to('1a66220c6f-7bb7a4@inbox.mailtrap.io')->send(new Notificacao );
            return redirect()->route('clientes.index')->with('verde','Email enviado');
        }
        else{
            return view('home');
        }
        
    }

    public function index(){

        if(auth()->check()){
            $clientes = Cliente::all();

    		return view ('clientes.index', [
    			'clientes'=>$clientes
    		]);
        }
        else{
            return view('home');
        }
    }

    public function show(Request $r){

        if(auth()->check()){
            $idCliente = $r->id;

            $clientes = Cliente::where('id_cliente',$idCliente)->with('encomenda')->first();

    		return view('clientes.show',[
    			'clientes'=>$clientes
    		]);
        }
        else{
            return view('home');
        }
    }

    public function create(){

        if(auth()->check()){

            return view('clientes.create');
        }
        else{
            return view('home');
        }
        
    }

    public function store(Request $req){

        if(auth()->check()){
            $novoCliente=$req->validate([
                'nome'=>['required','min:3','max:100'],
                'morada'=>['required','min:3','max:100'],
                'telefone'=>['required','min:9','max:13'],
                'email'=>['required','min:5','max:200'],
                'foto_cliente'=>['nullable','image','max:2000']
            ]);

            if($req->hasFile('foto_cliente')){
                $nomeImagem=$req->file('foto_cliente')->getClientOriginalName();
                $nomeImagem=time().'_'.$nomeImagem;
                $guardarImagem=$req->file('foto_cliente')->storeAs('imagens/clientes',$nomeImagem);

                $novoCliente['foto_cliente']=$nomeImagem;
            }

            $cliente=Cliente::create($novoCliente);

            return redirect()->route('clientes.show',[
                'id'=>$cliente->id_cliente
            ])->with('verde','Cliente Criado');
        }
        else{
            return view('home');
        }
    }

    public function edit(Request $req){

        $idCliente=$req->id;
        $cliente=Cliente::where('id_cliente',$idCliente)->first();
        if(auth()->check()){
        
            if(Gate::allows('gate',$cliente) || Gate::allows('admin')){
                return view('clientes.edit',[
               'cliente'=>$cliente
                ]);
            }
            else{
                return redirect()->route('clientes.index')->with('vermelho','Nao tem permissao');
            }
            
        }
        else{
            return view('home');
        }
    }

    public function update(Request $req){

        if(auth()->check()){
            $idCliente=$req->id;
            $cliente=Cliente::where('id_cliente',$idCliente)->first();
            $imagemAntiga=$cliente->foto_cliente;
            
            if(Gate::allows('gate',$cliente) || Gate::allows('admin')){
                $editarCliente=$req->validate([

                    'nome'=>['required','min:3','max:100'],
                    'morada'=>['required','min:5','max:100'],
                    'telefone'=>['required','min:9','max:13'],
                    'email'=>['required','min:5','max:200'],
                    'foto_cliente'=>['nullable','image','max:2000']
                ]);
                
                if($req->hasFile('foto_cliente')){
                    $nomeImagem=$req->file('foto_cliente')->getClientOriginalName();
                    $nomeImagem=time().'_'.$nomeImagem;
                    $guardarImagem=$req->file('foto_cliente')->storeAs('imagens/clientes',$nomeImagem);

                    if(!is_null($imagemAntiga)){

                        Storage::Delete('imagens/clientes/'.$imagemAntiga);
                    }

                    $editarCliente['foto_cliente']=$nomeImagem;
                }

                $cliente->update($editarCliente);

                return redirect()->route('clientes.show',[
                    'id'=>$cliente->id_cliente
                ])->with('verde','Cliente editado');
            }
            else{
                return redirect()->route('clientes.index')->with('vermelho','Nao tem permissao');
            }
        }

        else{
            return view('home');
        }
    }

    public function destroy(Request $r){
        

        if(auth()->check()){
            $cliente= Cliente::where('id_cliente', $r->id)->first();
            $imagemAntiga=$cliente->foto_cliente;

            if(Gate::allows('gate',$cliente) || Gate::allows('admin')){
                if(is_null($cliente)){

                        return redirect()->route('clientes.index')->with('vermelho','O cliente não existe');
                    }
                    else{

                        if(!is_null($imagemAntiga)){

                            Storage::Delete('imagens/clientes/'.$imagemAntiga);
                        }
                        $cliente->delete();
                        return redirect()->route('clientes.index')->with('vermelho','Cliente eliminado');
                    }
                 } 
            else{
                return redirect()->route('clientes.index')->with('vermelho','Nao tem permissao');
            }
        }
        else{
            return route('home');
        }
    }
}
