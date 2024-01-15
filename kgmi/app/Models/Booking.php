<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory,SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id', 'created_at', 'updated_at']; 
    
    protected $fillable = [
        'booking_id',
        'booking_name',
        'booking_for',
        'booking_amount',
        'payment_mode',
        'team_name',
        'team_mobile_no',
        'photographer',
        'photographer_assistant',
        'cinematographer',
        'cinematographer_assistant',
        'models',
        'makeup_assitants',
        'makeup_artist',
        'hair_stylist',
        'dress_des',
        'plan_id',
        'address',
        'plan_description', 
        'start_date', 
        'end_date', 
        'start_time', 
        'end_time', 
        'name', 
        'email', 
        'mobile_no', 
        'status',  
    ];


    public function getPaymentInformations(){
        return $this->hasMany(PaymentInformation::class , 'id' , 'booking_id');
    }
}
