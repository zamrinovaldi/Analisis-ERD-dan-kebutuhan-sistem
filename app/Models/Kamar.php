<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamars';

    protected $fillable = [
        'nomor_kamar',
        'tipe_kamar',
        'harga',
        'status',
    ];

    /**
     * Get the tenants (penyewa) for the room.
     */
    public function penyewas(): HasMany
    {
        return $this->hasMany(Penyewa::class, 'kamars_id');
    }
}
