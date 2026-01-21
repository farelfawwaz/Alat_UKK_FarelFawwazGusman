<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();

            // Relasi
            $table->foreignId('alat_id')
                  ->constrained('alats')
                  ->cascadeOnDelete();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Tanggal
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();

            // Status peminjaman
            $table->enum('status', ['menunggu', 'dipinjam', 'dikembalikan'])
                  ->default('menunggu');

            // Catatan tambahan
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};

