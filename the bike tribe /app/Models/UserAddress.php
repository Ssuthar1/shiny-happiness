<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
     
   use HasFactory,SoftDeletes;

    protected $fillable = ['user_id', 'first_name','last_name','email','mobile','address_line_1','address_line_2','country','city','state','postcode','is_default'];

    public function getUserDetail(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

   
}
