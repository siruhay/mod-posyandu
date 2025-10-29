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
        Schema::create('posyandu_complaints', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->date('date');
            $table->foreignId('service_id');
            $table->foreignId('indicator_id')->nullable();
            $table->foreignId('community_id');
            $table->foreignId('village_id');
            $table->foreignId('subdistrict_id')->nullable();
            $table->foreignId('activity_id')->nullable();
            $table->foreignId('workunit_id')->nullable();
            $table->text('description');
            $table->jsonb('paths')->nullable();
            $table->enum('urgency', ['LOW', 'MEDIUM', 'HIGH'])->default('LOW');
            $table->enum('status', ['NEW', 'IN-PROGRESS', 'RESOLVED'])->default('NEW');
            $table->foreignId('user_id');
            $table->jsonb('meta')->nullable();
            $table->timestamp('responsed_at')->nullable();
            $table->timestamp('progressed_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posyandu_complaints');
    }
};
