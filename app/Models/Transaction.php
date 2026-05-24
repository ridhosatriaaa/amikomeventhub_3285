<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Tambahkan total_amount dan lainnya agar bisa diisi (Mass Assignment)
    protected $fillable = [
        'event_id',
        'name',
        'email',
        'phone',
        'total_amount',
        'status',
    ];

    // Relasi balik ke Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}