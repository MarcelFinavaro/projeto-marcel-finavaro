<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('ordem_servicos')) {
            Schema::create('ordem_servicos', function (Blueprint $table) {
                $table->id();

                // CPF como chave estrangeira
                $table->string('cpf');
                $table->foreign('cpf')->references('cpf')->on('clientes')->onDelete('cascade');

                // Placa como chave estrangeira
                $table->string('placa');
                $table->foreign('placa')->references('placa')->on('veiculos')->onDelete('cascade');

                $table->text('descricao');
                $table->date('data_servico');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('ordem_servicos');
    }
};
