<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    // Mendaftarkan kolom wajib sesuai instruksi soal agar bisa diinput masal
    protected $fillable = [
        'name',
        'logo_url',
    ];
}