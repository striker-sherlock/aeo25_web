<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationFacility extends Model
{
    use HasFactory;

    protected $table = 'accommodation_facilities';
    protected $primaryKey = 'id';
    protected $timestamp = 'true';
    protected $guarded = [];

    public function facility ()
    {
        return $this->belongsTo(Facility::class);
    }
}
