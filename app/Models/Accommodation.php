<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'jenis',
        'kasur',
        'merokok',
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
        'fasilitas' => 'array',
        'makanan' => 'array',
        'catatan' => 'array',
        'merokok' => 'boolean',
        'gambar' => 'array',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
