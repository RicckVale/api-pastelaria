<?php

namespace App\Models;

use Database\Factories\PedidosFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedidos extends Model
{
    use HasFactory, SoftDeletes;

    protected $factory = PedidosFactory::class;
    protected $fillable = ['codigo_do_cliente', 'codigo_do_produto'];

    // Relacionamento com Cliente
    public function clientes()
    {
        return $this->hasOne(Clientes::class, 'id', 'codigo_do_cliente');
    }

    // Relacionamento com Produto
    public function produtos()
    {
        return $this->hasOne(Produtos::class, 'id', 'codigo_do_produto');
    }
}
