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
            $table->decimal('mao_obra', 10, 2)->default(0)->after('data_servico');
            // Se quiser salvar o total calculado:
            // $table->decimal('valor_total', 10, 2)->nullable()->after('mao_obra');
        });
    }

    public function down(): void
    {
        Schema::table('ordem_servicos', function (Blueprint $table) {
            $table->dropColumn('mao_obra');
            // $table->dropColumn('valor_total');
        });
    }
};
