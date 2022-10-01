<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $table = 'booking_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];




public function transaksi()
    {
        return $this->belongsTo(Transaksi::class,"id_transaksi");
    }

public function kamar()
    {
        return $this->belongsTo(Kamar::class,"id_kamar");
    }
}