<?php

namespace App\Models;

use App\Models\User;
use App\Models\Competition;
use App\Models\CompetitionPayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompetitionSlot extends Model
{
    use HasFactory;
    protected $table = 'competition_slot_details';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
    
    public function user(){
        return $this-> belongsTo(User::class,'pic_id','id');
    }

    public function competition(){
        return $this-> belongsTo(Competition::class);
    }

    public function payment(){
        return $this-> belongsTo(CompetitionPayment::class);
    }



  
}
