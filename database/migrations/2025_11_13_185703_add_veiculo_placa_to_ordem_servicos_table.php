<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ordem_servicos', function (Blueprint $table) {
            // Adiciona a coluna veiculo_placa e define como chave estrangeira
            $table->string('veiculo_placa')->after('id');
            $table->foreign('veiculo_placa')
                  ->references('placa')
                  ->on('veiculos')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ordem_servicos', function (Blueprint $table) {
            // Remove a chave estrangeira e a coluna
            $table->dropForeign(['veiculo_placa']);
            $table->dropColumn('veiculo_placa');
        });
    }
};
