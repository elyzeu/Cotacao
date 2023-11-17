<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprovante extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Adicione 'user_id' ao array $fillable
        // Outras colunas que você deseja permitir preenchimento em massa
    ];

    // Restante do seu modelo...
}




