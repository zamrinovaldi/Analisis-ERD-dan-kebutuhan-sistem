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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_bayar');
            $table->integer('jumlah');
            $table->string('metode_pembayaran'); // e.g. Transfer, Tunai
            $table->string('status'); // e.g. Lunas, Pending, Gagal
            $table->foreignId('penyewas_id')->constrained('penyewas')->cascadeOnDelete();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
