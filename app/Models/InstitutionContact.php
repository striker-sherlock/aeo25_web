<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionContact extends Model
{
    use HasFactory;

    protected $table = 'institution_contacts';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;

    public function admin()
    {
        return $this->hasOne('App\Models\Admin', 'id', 'admin_id');
    }
    
}
