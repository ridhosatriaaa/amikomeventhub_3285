<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * Properti yang diizinkan untuk diisi secara massal (Mass Assignment).
     * Sesuaikan nama kolom (misal: 'total_price' vs 'total_amount') 
     * dengan yang ada di file migration database kamu.
     */
    protected $fillable = [
        'event_id', 
        'order_id', 
        'customer_name', 
        'customer_email', 
        'customer_phone', 
        'total_price', 
        'status', 
        'snap_token'
    ];

    /**
     * Relasi balik (Inverse One-to-Many) ke model Event.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}