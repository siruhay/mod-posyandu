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
        /**
         * DRAFTED = Saat Keluhan Di Catat dan Di Simpan
         * VERIFIED = Saat Keluhan telah di verifikasi bersama perangkat desa dan di kirim ke perangkat desa
         * REJECTED = Saat Keluhan di tolak oleh kader pasca verifikasi
         * SUBMITTED = Saat Keluhan di verifikasi perangkat desa dan di kirimkan ke admin posyandu
         * COMPLETED = Saat Keluhan di verifikasi dan di selesaikan pada level perangkat desa / OPD
         * DETERMINATED = Saat Keluhan di verifikasi admin dan di tentukan OPD penanggung-jawab
         */
        Schema::create('posyandu_activities', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->date('date');
            $table->foreignId('service_id');
            $table->foreignId('community_id');
            $table->string('executor');
            $table->text('description');
            $table->integer('participants_count')->default(0);
            $table->foreignId('workunit_id')->nullable();
            $table->enum('status', ['DRAFTED','VERIFIED','REJECTED','SUBMITTED','COMPLETED','DETERMINATED']);
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
        Schema::dropIfExists('posyandu_activities');
    }
};
