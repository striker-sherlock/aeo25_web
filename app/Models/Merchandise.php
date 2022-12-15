<?php

namespace App\Models;

use App\Models\MerchandiseOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Merchandise extends Model
{
    use HasFactory;
    protected $table = 'merchandises';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;

    public function merhandiseOrders(){
        return $this->hasMany(MerchandiseOrder::class) ;
    }
}
