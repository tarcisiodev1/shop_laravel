<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'nome_completo',
        'cpf',
        'nascimento',
        'endereco',
        'cep',
    ];

    // Relacionamento: Um cliente pode ter vários pedidos
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
