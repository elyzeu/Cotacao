<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos'; // Nome da tabela no banco de dados

    protected $fillable = [
        'nompro', // Nome do produto
        'codpro', // Preço do produto
        // Outros campos se aplicável
    ];

    // Se você tiver relacionamentos com outros modelos, defina-os aqui
    // Exemplo de relacionamento com pedidos:
    public function pedidos()
    {
        return $this->hasMany(PedidoItem::class, 'produto_id');
    }
}
