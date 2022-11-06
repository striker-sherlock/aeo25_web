<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AccomodationFacility;

class Facilities extends Model
{
    use HasFactory;
    protected $table = 'facilities';
    protected $primaryKey = 'id';
    protected $timestamp = 'true';
    protected $guarded = [];

    public function accomodationFacility(){
        return $this->hasMany(AccomodationFacility::class);
    }
}
