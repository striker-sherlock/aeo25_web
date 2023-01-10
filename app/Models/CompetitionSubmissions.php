<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompetitionSubmissions extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'competition_submissions';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function teamSubmitter()
    {
        return $this->belongsTo(CompetitionTeam::class,'submitter_id','id');
    }

    public function participantSubmitter () 
    {
        return $this->belongsTo(CompetitionParticipant::class, 'submitter_id', 'id');
    }

    public function competition () 
    {
        return $this->belongsTo(Competition::class);
    }

    

}
