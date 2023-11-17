<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoItemsTable extends Migration
{
    public function up()
    {
        Schema::create('pedido_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id'); // Substitua 'unsignedInteger' por 'unsignedBigInteger'
            $table->string('produto_id');
            $table->integer('qtd_item');
            $table->text('descricao')->nullable();
            $table->string('prazo');
           
            $table->timestamps();
        
            // Adicione a chave estrangeira
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedido_items');
    }
}
