<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [  
        'title', 
        'description', 
        'name',
        'designation',
        'image',
        'status',              

    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function mainImage()
    {
         return $this->hasOne(ImageInfo::class,'property_id','id')->where('image_position','main_image');
    }
}
