<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsors extends Model
{
    use HasFactory;
    protected $table = 'sponsors';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
}
