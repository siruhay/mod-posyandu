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
            $table->enum('source', ['APBDES','APBD_DISTRICT','APBD_PROVINCE','APBN','CSR','COMMUNITY', 'OTHER']);
            $table->decimal('budget')->default(0);
            $table->decimal('realized')->default(0);
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
