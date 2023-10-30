<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Film;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genres';
    protected $fillable = ['nama'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
