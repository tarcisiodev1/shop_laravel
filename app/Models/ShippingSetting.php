<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingSetting extends Model
{
    use HasFactory;

    protected $table = 'shipping_settings';

    protected $fillable = [
        'product_id',
        'cep_origem',
        'informacoes_frete',
    ];

    // Relacionamento: As configurações de frete pertencem a um produto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
