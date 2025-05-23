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
        Schema::create('posyandu_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('address')->nullable();
            $table->foreignId('regency_id');
            $table->foreignId('subdistrict_id');
            $table->foreignId('village_id');
            $table->string('phone', 14)->nullable();
            $table->string('nik', 16)->nullable();
            $table->string('scope')->index();
            $table->text('complaint');
            $table->date('complaint_date')->index()->nullable();
            $table->date('verified_date')->index()->nullable();
            $table->date('completed_date')->index()->nullable();
            $table->enum('financing_source', ['APBDES', 'APBD', 'APBN', 'LAINNYA'])->index()->nullable();
            $table->string('financing_other')->index()->nullable();
            $table->double('financing_draft')->default(0);
            $table->double('financing_amount')->default(0);
            $table->foreignId('cadre_id')->nullable();
            $table->foreignId('officer_id')->nullable();
            $table->foreignId('workunit_id')->nullable();
            $table->enum('status', ['DRAFTED', 'REJECTED', 'VERIFIED', 'SUBMITTED', 'DETERMINATED', 'COMPLETED'])->index()->default('DRAFTED');
            $table->jsonb('drafted_files')->nullable();
            $table->jsonb('verified_files')->nullable();
            $table->jsonb('logs')->nullable();
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
        Schema::dropIfExists('posyandu_submissions');
    }
};
