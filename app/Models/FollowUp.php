<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FollowUp extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'follow_ups';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function creator()
    {
        return $this->hasOne('App\Models\Admin', 'id', 'creator_id');
    }

    public function pic()
    {
        return $this->hasOne('App\Models\Admin', 'id', 'pic_id');
    }

    public function admin()
    {
        return $this->hasOne('App\Models\Admin', 'id', 'admin_id');
    }

    public function type()
    {
        return $this->hasOne('App\Models\FollowUpType', 'id', 'type_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    
}
