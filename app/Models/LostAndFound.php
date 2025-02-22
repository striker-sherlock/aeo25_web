<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostAndFound extends Model
{
    use HasFactory;

    protected $table = 'lost_and_found';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
}
