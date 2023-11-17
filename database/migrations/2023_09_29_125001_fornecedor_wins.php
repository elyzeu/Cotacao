<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fornecedorwins', function (Blueprint $table) {
            $table->id();
            $table->float('valor');
            $table->string('email');
            $table->string('emailcomprador');
            $table->string('nomeproduto');
            $table->decimal('quantidade');
            $table->string('data_entrega');
            $table->decimal('user_id');
            $table->string('desc');
            $table->boolean('status');
        
           // $table->foreign('user_id')->references('id')->on('users');

            $table->decimal('pedido_id');
           // $table->foreign('pedido_id')->references('id')->on('pedidos');
           
            $table->decimal('fornecedor_id');
          //  $table->foreign('fornecedor_id')->references('idaux')->on('fornecedores');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedorwins');
    }
};
