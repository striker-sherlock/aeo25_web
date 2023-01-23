<?php

namespace App\Models;

use App\Models\FlightTicket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PickUpSchedule extends Model
{
    use HasFactory;
    protected $table = 'pick_up_schedules';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function flightTickets(){
        return $this->hasMany(FlightTicket::class,'schedule_id','id');
    }
}
