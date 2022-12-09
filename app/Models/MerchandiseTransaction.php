<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchandiseTransaction extends Model
{
    use HasFactory;

    protected $table = 'merhandise_transactions';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
    
    public function merhandiseOrder(){
        return $this->hasMany(MerchandiseOrder::class);
    }
}
