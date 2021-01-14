<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    use HasFactory;

    protected $primaryKey="id_encomenda";
    protected $table="encomendas";

    public function cliente(){

        return $this->belongsTo('App\Models\Cliente','id_cliente');
    }

    public function vendedor(){

        return $this->belongsTo('App\Models\Vendedor','id_vendedor');
    }

    public function encomenda_produto(){

        return $this->belongsTo('App\Models\EncomendaProduto','id_encomenda');
    }

    public function produtos(){

        return $this->belongsToMany('App\Models\Produto','encomendas_produtos', 'id_encomenda', 'id_produto');
    }

    protected $fillable=[

        'id_cliente',
        'id_vendedor',
        'data',
        'observacoes'
        
    ];
}
