<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessControl extends Model
{
    use HasFactory;
    protected $table = 'access_controls';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];


    public function access()
    {
        return $this->belongsTo('App\Models\Access', 'id', 'access_id');
    }

     

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'id', 'admin_id');
    }
}
