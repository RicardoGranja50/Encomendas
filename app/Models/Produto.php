<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $primaryKey="id_produto";
    protected $table="produtos";

    public function encomenda_produto(){

        return $this->hasMany('App\Models\EncomendaProduto','id_enc_prod');
    }

    public function encomendas(){

        return $this->belongsToMany('App\Models\Encomenda','encomendas_produtos', 'id_produto', 'id_encomenda');
    }

     protected $fillable=[

        'designacao',
        'stock',
        'preco',
        'observacoes'
        
    ];
}
