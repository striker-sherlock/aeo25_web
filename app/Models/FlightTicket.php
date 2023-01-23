<?php

namespace App\Models;

use App\Models\PickUpSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FlightTicket extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'flight_tickets';
    protected $primaryKey = 'id';
    protected $timestamp = 'true';
    protected $guarded = [];
    
    public function userPic(){
        return $this->belongsTo(User::class, 'pic_id', 'id');
    }

    public function pickUpSchedule(){
        return $this->belongsTo(PickUpSchedule::class,'schedule_id','id');
    }
}

