<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'duration',
        'minimum_age',
        'trailer_url',
        'poster_url',
        'genre',
        'release_date',
        'status'
    ];

    protected $casts = [
        'release_date' => 'datetime',
        'duration' => 'integer',
        'minimum_age' => 'integer',
    ];

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }

    public function bookings()
    {
        return $this->hasManyThrough(Booking::class, Showtime::class);
    }
}