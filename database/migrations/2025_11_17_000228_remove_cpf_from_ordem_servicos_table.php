<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ordem_servicos', function (Blueprint $table) {
            // Verifica se a coluna existe antes de tentar remover
            if (Schema::hasColumn('ordem_servicos', 'cpf')) {
                // Remove a foreign key se ela existir
                DB::statement('ALTER TABLE ordem_servicos DROP FOREIGN KEY IF EXISTS ordem_servicos_cpf_foreign');
                $table->dropColumn('cpf');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ordem_servicos', function (Blueprint $table) {
            $table->string('cpf');
            $table->foreign('cpf')->references('cpf')->on('clientes')->onDelete('cascade');
        });
    }
};
