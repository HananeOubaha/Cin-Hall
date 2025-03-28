<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'theater_id',
        'start_time',
        'end_time',
        'type',
        'language',
        'price'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'price' => 'decimal:2'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function theater()
    {
        return $this->belongsTo(Theater::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function availableSeats()
    {
        $bookedSeats = $this->bookings()
            ->where('status', 'confirmed')
            ->pluck('seat_ids')
            ->flatten()
            ->unique();

        return $this->theater->seats()
            ->whereNotIn('id', $bookedSeats)
            ->get();
    }
}