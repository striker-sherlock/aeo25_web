<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Countries;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pic_name',
        'username',
        'pic_email',
        'pic_phone_number',
        'country_id',
        'email',
        'institution_name',
        'institution_email',
        'institution_type',
        'institution_logo',
        'password',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function country(){
        return $this-> hasOne(Countries::class,'id','country_id');
    } 

    public function confirmedSlotExist()
    {
        return $this->hasMany(CompetitionSlot::class)->where('is_confirmed', '=', 1);
    }

    public function competitionSlotDetail()
    {
        return $this->hasMany(CompetitionSlot::class,'id','pic_id');

    }


}
