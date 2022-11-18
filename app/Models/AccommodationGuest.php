<?php

namespace App\Models;
use App\Models\AccommodationSlot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationGuest extends Model
{
    use HasFactory;
    protected $table = 'accommodation_guests';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
    
    public function accommodation(){
        return $this->belongsTo(Accommodation::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'pic_id','id');
    }

    public function accommodationSlot(){
        return $this->belongsTo(AccommodationSlot::class);
    }
}
