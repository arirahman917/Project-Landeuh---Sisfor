<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_pesanan',
        'accommodation_id',
        'pemesan_nama',
        'pemesan_telp',
        'pemesan_email',
        'nama_tamu',
        'check_in_date',
        'check_out_date',
        'malam',
        'tambahan_anak',
        'tambahan_dewasa',
        'total',
        'metode_pembayaran',
        'status',
    ];

    protected $casts = [
        'check_in_date' => 'date:Y-m-d',
        'check_out_date' => 'date:Y-m-d',
    ];

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
