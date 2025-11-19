<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('veiculos', function (Blueprint $table) {
            $table->string('marca')->after('modelo');
        });
    }

    public function down(): void
    {
        Schema::table('veiculos', function (Blueprint $table) {
            if (Schema::hasColumn('veiculos', 'marca')) {
                $table->dropColumn('marca');
            }
        });
    }
};
