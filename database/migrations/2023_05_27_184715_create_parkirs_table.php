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
            $table->unsignedBigInteger('petugas_id')->nullable()->comment('petugas parkir');
            $table->string('code_qr');
            $table->string('foto_wajah')->default('default.jpg');
            $table->string('foto_plat')->default('default.jpg');
            $table->enum('status',['Masuk', 'Keluar'])->default('Masuk');
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
