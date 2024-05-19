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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->bigInteger('subject_id')->unsigned();
            $table->string('hari');
            $table->string('jam_mulai');
            $table->string('jam_selesai');
            $table->string('ruangan');
            $table->string('kode_absensi');
            $table->string('tahun_akademik');
            $table->string('semester');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
=======
            $table->string('title');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('category');
            $table->timestamps();
>>>>>>> 772407a (bug calander)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
