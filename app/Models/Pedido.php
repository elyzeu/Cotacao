<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Valore;
use App\Models\PedidoItem;

class Pedido extends Model
{
    use HasFactory;
    
    protected $fillable = [
        // Outras propriedades preenchíveis aqui
        'status',
    ];

    public function pedidoItens()
    {
        return $this->hasMany(PedidoItem::class);
    }

    public function valores()
    {
        return $this->hasMany(Valore::class, 'pedido_id', 'id');
    }
    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
 
}
