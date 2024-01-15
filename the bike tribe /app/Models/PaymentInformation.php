<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentInformation extends Model
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
        'amount',
        'transaction_date', 
        'transaction_id', 
        'payment_information', 
        'status',  
    ];


    public function getBookingDetail(){
        return $this->belongsTo(Booking::class , 'booking_id' , 'id');
    }
}
