<?php

namespace App\Models;

use App\Models\CompetitionPayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentProvider extends Model
{
    use HasFactory;

    protected $table = 'payment_providers';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function payment(){
        return $this-> belongsTo(CompetitionPayment::class,'payment_id','id');
    }
 
}
