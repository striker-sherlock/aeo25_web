<?php

namespace App\Models;

use App\Models\Competition;
use App\Models\CompetitionParticipant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompetitionTeam extends Model
{
    use HasFactory;
    protected $table = 'competition_teams';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function competitionParticipant(){
        return $this->hasMany(CompetitionParticipant::class,'team_id','id');
    }

    public function teamSubmission () 
    {
        return $this->hasOne(CompetitionSubmissions::class, 'submitter_id', 'id')
            ->join('competitions', 'competitions.id', 'competition_submissions.competition_id')
            ->where('competitions.id', 'RD');
    }
}
