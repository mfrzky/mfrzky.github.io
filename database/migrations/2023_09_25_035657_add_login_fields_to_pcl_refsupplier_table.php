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
        Schema::table('PCL_REFSUPPLIER', function (Blueprint $table) {
            $table->datetime('LAST_LOGIN_AT')->nullable();
            $table->string('LAST_LOGIN_IP')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('PCL_REFSUPPLIER', function (Blueprint $table) {
            //
        });
    }
};
