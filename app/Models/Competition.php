<?php

namespace App\Models;

use App\Models\CompetitionSlot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Competition extends Model
{
    use HasFactory;
    protected $table = 'competitions';
    protected $primarykey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $guarded = [];

    public function competitionSlot(){
        return $this-> hasMany(CompetitionSlot::class);
    }

    public function registeredSlots () 
    {
        return $this->hasMany(CompetitionSlotDetail::class)->where('pic_id', '=', Auth::user()->id);
    }
}
