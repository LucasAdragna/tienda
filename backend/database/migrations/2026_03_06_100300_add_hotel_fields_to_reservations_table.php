<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table): void {
            $table->date('check_in')->nullable()->after('reservation_date');
            $table->date('check_out')->nullable()->after('check_in');
            $table->string('room_type', 120)->nullable()->after('check_out');
            $table->unsignedTinyInteger('adults')->default(1)->after('room_type');
            $table->unsignedTinyInteger('children')->default(0)->after('adults');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table): void {
            $table->dropColumn(['check_in', 'check_out', 'room_type', 'adults', 'children']);
        });
    }
};
