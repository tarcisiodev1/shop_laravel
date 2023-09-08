<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items'; // Nome da tabela

    protected $fillable = [
        'order_id',
        'product_id',
        'quantidade',
        'subtotal',
    ];

    // Relacionamento: Um item do pedido pertence a um pedido
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relacionamento: Um item do pedido pertence a um produto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
