<?php

namespace App\Models;

use App\Models\User;
use App\Models\Accommodation;
use App\Models\AccommodationPayment;
use App\Models\AccommodationGuest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationSlot extends Model
{
    use HasFactory;
    protected $table = 'accommodation_slot_details';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class,'pic_id','id');
    }

    public function accommodation(){
        return $this->belongsTo(Accommodation::class);
    }

    public function accommodationPayment(){
        return $this->belongsTo(AccommodationPayment::class,'payment_id','id');
    }
    
    public function accommodationGuest(){
        return $this->hasMany(AccommodationGuest::class);
    }
}
