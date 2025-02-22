<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
    use HasFactory;
    protected $table = "environments";
    protected $primaryKey = "id";
    protected $timestamp = true;
    protected $guarded = [];

}
