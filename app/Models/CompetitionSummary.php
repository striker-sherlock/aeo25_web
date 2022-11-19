<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionSummary extends Model
{
    use HasFactory;
    protected $table = 'competition_summaries';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
}
