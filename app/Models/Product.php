<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $table = 'products'; // Nome da tabela

    protected $fillable = [
        'nome',
        'valor',
        'dimensoes',
        'peso',
    ];

    // Relacionamento: Um produto pode ter várias imagens
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
