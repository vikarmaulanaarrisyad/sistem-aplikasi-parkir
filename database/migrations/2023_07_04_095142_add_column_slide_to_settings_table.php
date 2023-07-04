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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('slide1')->default('default.jpg');
            $table->string('slide2')->default('default.jpg');
            $table->string('slide3')->default('default.jpg');
            $table->string('slide4')->default('default.jpg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
          $table->dropColumn([
            'slide1',
            'slide2',
            'slide3',
            'slide4',
          ]);
        });
    }
};
