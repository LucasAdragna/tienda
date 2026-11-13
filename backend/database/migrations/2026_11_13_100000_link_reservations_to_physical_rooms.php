<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table): void {
            $table->foreignId('product_id')->nullable()->constrained('products')->restrictOnDelete();
            $table->index(['product_id', 'status', 'check_in', 'check_out'], 'reservations_room_dates_index');
        });

        // Preserve unmatched legacy records for manual review; never guess by display name.
        DB::table('products')->select('id', 'slug')->orderBy('id')->chunkById(200, function ($rooms): void {
            foreach ($rooms as $room) {
                DB::table('reservations')->whereNull('product_id')->where('room_type', $room->slug)
                    ->update(['product_id' => $room->id]);
            }
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table): void {
            $table->dropIndex('reservations_room_dates_index');
            $table->dropConstrainedForeignId('product_id');
        });
    }
};
