<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprovantesTable extends Migration
{
    public function up()
    {
        Schema::create('comprovantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('caminho_do_arquivo');
            $table->timestamps();

            // Define a chave estrangeira para associar o comprovante ao usuário
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comprovantes');
    }
}
