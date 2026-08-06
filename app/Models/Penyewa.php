<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penyewa extends Model
{
    use HasFactory;

    protected $table = 'penyewas';

    protected $fillable = [
        'nama',
        'no_hp',
        'email',
        'pekerjaan',
        'kamars_id',
        'tanggal_masuk',
        'tanggal_keluar',
    ];

    /**
     * Get the duration of stay (number of nights).
     */
    public function getDurasiMenginapAttribute()
    {
        $masuk = \Carbon\Carbon::parse($this->tanggal_masuk);
        $keluar = \Carbon\Carbon::parse($this->tanggal_keluar);
        return max(1, $masuk->diffInDays($keluar));
    }

    /**
     * Get the total room rental cost based on duration.
     */
    public function getTotalBiayaAttribute()
    {
        if (!$this->kamar) {
            return 0;
        }
        return $this->durasi_menginap * $this->kamar->harga;
    }

    /**
     * Get the room (kamar) that the tenant occupies.
     */
    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class, 'kamars_id');
    }

    /**
     * Get the payments (pembayaran) for the tenant.
     */
    public function pembayarans(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'penyewas_id');
    }
}
