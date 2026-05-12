<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     * (Opsional jika nama tabel Anda sudah 'partners')
     */
    protected $table = 'partners'; 

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     * Sangat penting untuk Tugas 4 (Simpan Data).
     */
    protected $fillable = [
        'name',    
        'logo_url', 
    ];
}