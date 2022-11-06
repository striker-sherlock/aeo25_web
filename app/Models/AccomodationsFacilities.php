<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accomodation;
use App\Models\Facility;

class AccomodationFacility extends Model
{
    use HasFactory;
    protected $table = 'accomodations_facilities';
    protected $primaryKey = 'id';
    protected $timestamp = 'true';
    protected $guarded = [];

    public function accomodation(){
        return $this->belongsTo(Accomodation::class);
    }

    public function facility(){
        return $this->belongsTo(Facility::class);
    }
}
