<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchandiseTransaction extends Model
{
    use HasFactory;

    protected $table = 'merchandise_transactions';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
    
    public function merchandiseOrder(){
        return $this->hasMany(MerchandiseOrder::class,'transaction_id','id');
    }
    public function paymentProvider(){
        return $this->belongsTo(PaymentProvider::class);
    }
}
