<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('sobre_nosotros')) {
            return;
        }

        Schema::create('sobre_nosotros', function (Blueprint $table): void {
            $table->increments('so_id');
            $table->string('so_titulo', 150);
            $table->string('so_texto', 150);
            $table->string('so_imagen', 200);
            $table->string('so_pdf', 150);
            $table->boolean('so_activo')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sobre_nosotros');
    }
};
