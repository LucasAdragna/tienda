<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table): void {
            $table->id();
            $table->string('customer_name', 120);
            $table->string('customer_email', 120);
            $table->string('customer_phone', 30);
            $table->dateTime('reservation_date');
            $table->unsignedTinyInteger('people_count');
            $table->enum('status', ['pendiente', 'confirmada', 'cancelada', 'completada'])->default('pendiente');
            $table->string('notes', 1000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
