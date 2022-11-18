<?php

namespace App\Models;

use App\Models\CompetitionSlot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competition extends Model
{
    use HasFactory;

    protected $primarykey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $guarded = [];

    public function competitionSlot(){
        return $this-> hasMany(CompetitionSlot::class);
    }
}
