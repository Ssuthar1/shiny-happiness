<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'mobile_no',
        'mobile_otp',
        'email_otp',
        'password',
        'status',
    ];

    protected $guarded = ['id', 'created_at', 'updated_at']; 

    
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
        'password' => 'hashed',
    ];

    /*Get all deposit record relationship*/
    public function getDepositDetails(){
        return $this->hasMany(Deposit::class, 'user_id' ,'user_id');
    }
    /*End*/

    /*Get all account record relationship*/
    public function getAccountDetails(){
        return $this->hasMany(Account::class, 'user_id' ,'user_id');
    }
    /*End*/

    /*Get bank detail relationship*/
    public function getBankDetailDetail(){
        return $this->hasOne(Account::class, 'user_id' ,'user_id');
    }
    /*End*/
}
