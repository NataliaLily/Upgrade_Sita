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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id(); // int auto_increment primary key
            $table->char('no_mhs', 10)->unique();
            $table->char('nama', 50)->nullable();
            $table->char('almt', 50)->nullable();
            $table->char('tmp_lahir', 30)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->char('j_kelamin', 1)->nullable();
            $table->unsignedBigInteger('id_user');
            $table->timestamp('waktu')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedBigInteger('id_dosen_wali')->default(1);
            $table->char('no_cama', 10)->default('');
            $table->integer('lulus')->default(0)->nullable();
            $table->integer('is_do')->default(0);
            $table->integer('is_transfered')->default(0);
            $table->string('email_utama', 200)->default('');
            $table->string('email_universitas', 200)->default('');
            $table->string('nomer_whatsapp', 20)->default('');

            // Foreign key ke tabel dosen
            $table->foreign('id_dosen_wali')->references('id')->on('dosens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
