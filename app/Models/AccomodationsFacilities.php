<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accomodations;
use App\Models\Facilities;

class AccomodationsFacilities extends Model
{
    use HasFactory;
    protected $table = 'accomodations_facilities';
    protected $primaryKey = 'id';
    protected $timestamp = 'true';
    protected $guarded = [];

    public function accomodations(){
        return $this->hasMany(Accomodations::class);
    }

    public function facilities(){
        return $this->hasMany(Facilities::class);
    }
}
