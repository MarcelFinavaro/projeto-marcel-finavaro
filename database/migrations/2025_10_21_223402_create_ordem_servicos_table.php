<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemServicosTable extends Migration
{
    public function up()
    {
        Schema::create('ordem_servicos', function (Blueprint $table) {
    $table->id();
    $table->string('cliente_cpf');
    $table->foreign('cliente_cpf')->references('cpf')->on('clientes')->onDelete('cascade');

    $table->string('veiculo_placa');
    $table->foreign('veiculo_placa')->references('placa')->on('veiculos')->onDelete('cascade');

    $table->text('descricao');
    $table->date('data_servico');
    $table->timestamps();
    });
    }

    public function down()
    {
        Schema::dropIfExists('ordem_servicos');
    }
}
