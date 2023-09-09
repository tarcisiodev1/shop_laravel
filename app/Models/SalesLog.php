<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesLog extends Model
{
    use HasFactory;

    protected $table = 'sales_logs';

    protected $fillable = [
        'order_id',
        'status',
    ];

    // Relacionamento: Um registro de log de venda pertence a um pedido
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
