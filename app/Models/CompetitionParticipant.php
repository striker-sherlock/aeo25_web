<?php

namespace App\Models;

use App\Models\CompetitionSlot;
use App\Models\CompetitionTeam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompetitionParticipant extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'competition_participants';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
    
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
}
