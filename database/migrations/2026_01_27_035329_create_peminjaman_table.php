<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel Alat
            $table->foreignId('alat_id')->constrained('alats')->onDelete('cascade');

            // Data peminjam
            $table->string('nama_peminjam');
            $table->string('alamat')->nullable();
            $table->string('no_telp')->nullable();

            // Tanggal
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();

            // Status
            $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
