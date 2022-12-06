<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function countries(){
        return $this->hasOne('App\Models\Countries', 'id', 'country_id');
    }

    public function admin(){
        return $this->hasOne('App\Models\Admin', 'id', 'admin_id');
    }
}
