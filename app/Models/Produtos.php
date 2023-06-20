<?php

namespace App\Models;

use App\Casts\Money;
use Database\Factories\ProdutosFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produtos extends Model
{
    use HasFactory, SoftDeletes;

    protected $factory = ProdutosFactory::class;
    protected $fillable = ['nome', 'preco', 'imagem'];
    protected $casts = [
        'preco' => Money::class,
    ];

    // Relacionamento com PedidosResource
    public function pedidos()
    {
        return $this->belongsTo(Pedidos::class, 'codigo_do_produto', 'id');
    }
}
