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
                $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
                $table->foreignId('veiculo_id')->constrained()->onDelete('cascade');
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
