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
        Schema::rename('users', 'users_admin');

        Schema::table('users_admin', function (Blueprint $table) {
            $table->boolean('visible')->default(true);
            $table->boolean('activo')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_admin', function (Blueprint $table) {
            $table->dropColumn(['visible', 'activo']);
        });

        Schema::rename('users_admin', 'users');
    }
};
