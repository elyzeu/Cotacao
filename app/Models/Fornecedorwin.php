<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedorwin extends Model
{
    use HasFactory;

    protected $fillable = ['fornecedor_id',
'pedido_id'];

}
