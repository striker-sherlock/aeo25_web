<?php

namespace App\Models;

use App\Models\CompetitionParticipant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SideAchievement extends Model
{
    use HasFactory;
    protected $table = 'side_achievements';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function competitionParticipant(){
        return $this ->hasOne(CompetitionParticipant::class, 'id', 'participant_id');
    }
}
