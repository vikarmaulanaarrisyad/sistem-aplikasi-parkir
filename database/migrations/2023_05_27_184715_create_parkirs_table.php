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
        Schema::create('parkirs', function (Blueprint $table) {
            $table->id();
            $table->string('code_barcode');
            $table->dateTime('date_in');
            $table->dateTime('date_out')->nullable();
            $table->string('path_image')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->enum('status_cam', [0, 1])->default(0)->comment('0 tangkap camera');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkirs');
    }
};
