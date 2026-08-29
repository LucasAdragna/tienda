<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table): void {
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_visible')->default(true);
        });

        $categories = DB::table('categories')->orderBy('id')->get();

        foreach ($categories as $index => $category) {
            DB::table('categories')
                ->where('id', $category->id)
                ->update([
                    'sort_order' => $index + 1,
                    'is_visible' => true,
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table): void {
            $table->dropColumn(['sort_order', 'is_visible']);
        });
    }
};
