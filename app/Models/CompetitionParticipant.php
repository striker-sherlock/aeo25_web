<?php

namespace App\Models;

use App\Models\FoodCoupon;
use App\Models\CompetitionSlot;
use App\Models\CompetitionTeam;
use App\Models\ParticipantRank;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompetitionParticipant extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'competition_participants';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
    protected $with = ['competition','user', 'competitionTeam','competitionSlot'];
    
    public function competition(){
        return $this->belongsTo(Competition::class);

    }

    public function user(){
        return $this->belongsTo(User::class,'pic_id','id');
    }
    
    public function competitionTeam(){
        return $this->belongsTo(CompetitionTeam::class,'team_id','id');
    }

    public function competitionSlot(){
        return $this->belongsTo(CompetitionSlot::class);
    }

    public function participantSubmission ()
    {
        return $this->hasOne(CompetitionSubmissions::class, 'submitter_id', 'id');
    }

    public function rank ()
    {
        return $this->hasOne(ParticipantRank::class, 'id', 'rank_id');
    }

    public function foodCoupon(){
        return $this->hasMany(FoodCoupon::class,'participant_id','id');
    }

    public function achievements ()
    {
        return $this->hasMany(SideAchievement::class);
    }
}
