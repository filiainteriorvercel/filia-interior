<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('progress');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We don't strictly need to recreate them in down() unless we want to be able to rollback perfectly.
        // But since these are "unused", we can leave down() empty or try to recreate them if we knew their schema.
        // For safety in a cleanup migration, it's often better to leave down empty or comment that data is lost.
        // However, to be proper, I should probably not try to recreate them without the exact schema.
        // I will leave it empty as this is a destructive cleanup requested by user.
    }
};
