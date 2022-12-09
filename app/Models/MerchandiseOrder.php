<?php

namespace App\Models;

use App\Models\Merchandise;
use App\Models\MerchandiseTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MerchandiseOrder extends Model
{
    use HasFactory;
    protected $table = 'merchandise_orders';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;

    public function merhandise(){
        return $this->belongsTo(Merchandise::class);
    }

    public function merhandiseTransaction(){
        return $this->belongsTo(MerchandiseTransaction::class);
    }

}
