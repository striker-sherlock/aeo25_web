<?php

namespace App\Models;
use App\Models\User;
use App\Models\Accommodation;
use App\Models\AccommodationSlot;
use App\Models\PaymentProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationPayment extends Model
{
    use HasFactory;
    protected $table = 'accommodation_payments';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'pic_id','id');
    }
    
    public function accommodationSlot(){
        return $this->hasMany(AccommodationSlot::class,'payment_id','id');
    }

    public function paymentProvider(){
        return $this->hasOne(PaymentProvider::class,'id','payment_provider_id');
    }
}
