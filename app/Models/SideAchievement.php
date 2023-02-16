<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SideAchievement extends Model
{
    use HasFactory;
    protected $table = 'side_achievements';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function competitionParticipant(){
        return $this ->hasOne(competitionParticipant::class, 'id', 'participant_id');
    }
}
