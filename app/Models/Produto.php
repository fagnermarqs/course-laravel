<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $table = "produtos";
    protected $fillable = [
        'nome',
        'preco',
        'desconto',
        'qtd_estoque',
        'categoria_id',
        'url'
    ];
    protected $guarded = ['_token'];
    
    public function __toString() {
        return $this->nome;
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }
}
