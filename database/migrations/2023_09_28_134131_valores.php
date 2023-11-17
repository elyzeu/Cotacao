<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('valores', function (Blueprint $table) {
            $table->id();
            $table->float('valor');
            $table->string('nompro');
            $table->unsignedBigInteger('user_id'); // Adicione um campo 'user_id'
            $table->unsignedBigInteger('pedido_id'); // Adicione um campo 'pedido_id'
            $table->unsignedBigInteger('fornecedor_id'); // Adicione um campo 'fornecedor_id'
            $table->timestamps();

            // Adicione as chaves estrangeiras
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->foreign('fornecedor_id')->references('idaux')->on('fornecedores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('valores');
    }
};
