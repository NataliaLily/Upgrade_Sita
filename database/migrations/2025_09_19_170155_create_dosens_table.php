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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->char('no_dosen', 4)->unique()->nullable();
            $table->string('nidn', 10)->default('');
            $table->char('gelar1', 20)->nullable();
            $table->char('nama_dosen', 50)->nullable();
            $table->char('gelar2', 20)->nullable();
            $table->char('rektor', 1)->nullable();
            $table->unsignedBigInteger('id_user');
            $table->boolean('is_active')->default(1);
            $table->timestamp('waktu')->useCurrent()->useCurrentOnUpdate();
        });

        // optional: kalau id_user relasi ke tabel users
        // $table->foreign('id_user')->references('id')->on('users');

    }

    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};
