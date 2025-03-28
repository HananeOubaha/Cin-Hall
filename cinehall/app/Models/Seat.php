<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'theater_id',
        'row',
        'number',
        'type',
        'status'
    ];

    public function theater()
    {
        return $this->belongsTo(Theater::class);
    }
}