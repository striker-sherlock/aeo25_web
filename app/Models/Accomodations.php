<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomodations extends Model
{
    use HasFactory;
    protected $table = 'accomodations';
    protected $primaryKey = 'id';
    protected $timestamp = 'true';
    protected $guarded = [];
    
    public function accomodationsFacilities(){
        return $this->belongsTo(AccomodationsFacilities::class);
    }
}
