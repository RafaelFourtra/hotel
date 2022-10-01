<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $guarded = [];

 
    public function bookingdetail()
    {
        return $this->hasMany(BookingDetail::class,"id_transaksi");
    }
}
