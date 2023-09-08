<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    use HasFactory;

    protected $table = 'payment_settings'; // Nome da tabela

    protected $fillable = [
        'method',
        'informacoes_necessarias',
    ];
}
