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
    ];

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
