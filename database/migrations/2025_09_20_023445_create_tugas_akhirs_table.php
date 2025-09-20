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
         Schema::create('tugas_akhirs', function (Blueprint $table) {
            $table->increments('id_tugas_akhir'); // PRIMARY KEY, AUTO_INCREMENT
            $table->string('link_dokumen', 255)->default('')->nullable();
            $table->string('judul_tugas_akhir', 230)->nullable();
            $table->integer('id_mhs')->nullable();
            $table->string('akdsem', 5)->nullable();
            $table->integer('id_dosen_pembimbing_1')->nullable();
            $table->integer('id_dosen_pembimbing_2')->nullable();
            $table->boolean('approve_doping_1_tugas_akhir')->default(0);
            $table->boolean('approve_doping_2_tugas_akhir')->default(0);
            $table->timestamps(); // default current_timestamp()
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_akhirs');
    }
};