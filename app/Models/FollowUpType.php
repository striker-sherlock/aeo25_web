<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUpType extends Model
{
    use HasFactory;
    protected $table = 'follow_up_types';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    
}
