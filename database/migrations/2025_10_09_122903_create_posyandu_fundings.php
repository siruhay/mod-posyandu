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
        Schema::create('posyandu_fundings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id');
            $table->foreignId('service_id')->nullable();
            $table->foreignId('indicator_id')->nullable();
            $table->foreignId('community_id')->nullable();
            $table->enum('source', ['APBDES','APBD_DISTRICT','APBD_PROVINCE','APBN','CSR','COMMUNITY', 'OTHER'])->nullable();
            $table->decimal('budget', 14, 2)->default(0);
            $table->decimal('realized', 14, 2)->default(0);
            $table->date('realization_date')->index()->nullable();
            $table->text('note')->nullable();
            $table->jsonb('paths')->nullable();
            $table->foreignId('user_id');
            $table->jsonb('meta')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posyandu_fundings');
    }
};
