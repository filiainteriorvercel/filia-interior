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
        Schema::table('progress_updates', function (Blueprint $table) {
            // Change foto column from string to longText to support base64 images
            $table->longText('foto')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('progress_updates', function (Blueprint $table) {
            $table->string('foto')->nullable()->change();
        });
    }
};
