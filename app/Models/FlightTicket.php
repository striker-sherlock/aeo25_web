<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}

