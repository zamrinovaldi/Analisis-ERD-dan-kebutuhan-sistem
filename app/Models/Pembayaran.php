<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $fillable = [
        'tanggal_bayar',
        'jumlah',
        'metode_pembayaran',
        'status',
        'penyewas_id',
        'keterangan',
    ];

    /**
     * Get the tenant (penyewa) who made the payment.
     */
    public function penyewa(): BelongsTo
    {
        return $this->belongsTo(Penyewa::class, 'penyewas_id');
    }
}
