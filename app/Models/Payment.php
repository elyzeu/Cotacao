<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Adicione 'user_id' ao array $fillable
        // Outros campos permitidos para mass assignment...
        'data_vencimento',
        'Data_pagamento'
    ];
}
