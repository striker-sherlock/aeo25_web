<?php

namespace App\Models;

use App\Models\User;
use App\Models\Competition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompetitionPayment extends Model
{
    use HasFactory;
    protected $table = 'competition_payments';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function user(){
        return $this-> belongsTo(User::class,'pic_id','id');
    }
    
    public function competitionSlot(){
        return $this-> hasMany(competitionSlot::class,'payment_id','id');
    }

}
