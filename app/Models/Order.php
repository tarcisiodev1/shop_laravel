<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; // Nome da tabela

    protected $fillable = [
        'customer_id',
        'total',
        'forma_de_pagamento',
    ];

    // Relacionamento: Um pedido pertence a um cliente
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relacionamento: Um pedido pode ter vários itens do pedido
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relacionamento: Um pedido pode ter um registro de log de venda
    public function salesLog()
    {
        return $this->hasOne(SalesLog::class);
    }
}
