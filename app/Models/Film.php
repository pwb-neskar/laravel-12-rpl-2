<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;
use App\Models\Peran;


class Film extends Model
{
    use HasFactory;

    protected $table = 'films';
    protected $fillable = [
        'judul',
        'ringkasan',
        'tahun',
        'poster',
        'genre_id',
    ];

    public function genre()
    {
        return $this->hasMany(Genre::class, 'id', 'genre_id');
    }
    
    public function peran()
    {
        return $this->hasMany(Peran::class);
    }

    
}
