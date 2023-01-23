<?php

namespace App\Models;

use App\Models\CompetitionParticipant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FoodCoupon extends Model
{
    protected $table = 'food_coupons';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;

    public function participant()
    {
        return $this->belongsTo(CompetitionParticipant::class, 'id', 'participant_id');
    }
}
