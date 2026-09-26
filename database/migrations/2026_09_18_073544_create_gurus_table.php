<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->increments('id_guru');
            $table->string('nip', 20); // Diperbesar dikit biar aman
            $table->string('nama_guru', 50);
            $table->string('mapel', 50);
            $table->string('jenis_kelamin', 20); // <--- INI YANG KURANG (KOLOM BARU)
            $table->string('foto', 100)->nullable(); // Ditambah ->nullable() biar foto boleh kosong
            $table->timestamps(); // Mencatat waktu buat & update data otomatis
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};