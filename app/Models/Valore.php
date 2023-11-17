<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PedidoItem;
use App\Models\Fornecedore;

class Valore extends Model
{
    use HasFactory;

    public function pedidoItem()
    {
        return $this->belongsTo(PedidoItem::class, 'pedidoitem_id');
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedore::class, 'fornecedor_id', 'idaux');
    }
    
}
