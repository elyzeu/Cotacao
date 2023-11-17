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
        Schema::table('valores', function (Blueprint $table) {
            $table->unsignedBigInteger('pedidoitem_id')->after('fornecedor_id'); // Adicione um campo 'pedidoitem_id'
            $table->foreign('pedidoitem_id')->references('id')->on('pedido_items'); // Defina a chave estrangeira
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('valores', function (Blueprint $table) {
            $table->dropForeign(['pedidoitem_id']); // Remova a chave estrangeira
            $table->dropColumn('pedidoitem_id'); // Remova o campo 'pedidoitem_id'
        });
    }
};
