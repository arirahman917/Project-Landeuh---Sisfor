<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporatePackage extends Model
{
    use HasFactory;

    protected $table = 'corporate_packages';

    protected $fillable = [
        'judul',
        'jenis',
        'jenis_akomodasi',
        'accommodation_ids',
        'fasilitas',
        'makanan',
        'max_orang',
        'catatan',
        'slot',
        'harga_weekday',
        'harga_weekend',
        'harga_highseason',
        'gambar',
    ];

    protected $casts = [
        'fasilitas'         => 'array',
        'makanan'           => 'array',
        'catatan'           => 'array',
        'gambar'            => 'array',
        'accommodation_ids' => 'array',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the Accommodation records linked to this corporate package.
     */
    public function accommodations()
    {
        $ids = $this->accommodation_ids ?? [];
        if (empty($ids)) {
            return Accommodation::whereRaw('1=0'); // empty relation
        }
        return Accommodation::whereIn('id', $ids);
    }
}
