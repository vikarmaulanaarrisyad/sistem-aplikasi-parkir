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
        Schema::table('parkirs', function (Blueprint $table) {
            $table->enum('is_cam1',[0,1])->default(0);
            $table->enum('is_cam2',[0,1])->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parkirs', function (Blueprint $table) {
            $table->dropColumn([
                'is_cam1',
                'is_cam2',
            ]);
        });
    }
};
