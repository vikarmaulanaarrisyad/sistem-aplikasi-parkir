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
            $table->string('logo_header')->default('default.jpg');
            $table->string('logo_favicon')->default('default.jpg');
            $table->string('login_header')->default('default.jpg');
            $table->string('logo_login')->default('default.jpg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'logo_header',
                'logo_favicon',
                'login_header',
                'logo_login',
            ]);
        });
    }
};
