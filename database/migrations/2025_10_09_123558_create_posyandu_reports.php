<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posyandu_reports', function (Blueprint $table) {
            $table->id();
            $table->string('period')->index();
            $table->foreignId('community_id');
            $table->enum('level', ['VILLAGE','DISTRICT','REGENCY','PROVINCE','NATIONAL']);
            $table->jsonb('data')->nullable();
            $table->enum('status', ['DRAFT','SUBMITTED','APPROVED','REJECTED']);
            $table->foreignId('verified_by')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posyandu_reports');
    }
};
