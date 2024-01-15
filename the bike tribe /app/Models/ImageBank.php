<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageBank extends Model
{
    use HasFactory,SoftDeletes; 

    protected $fillable = [         
        'title',
        'caption',
        'tags',
        'image_url',
        'big_url',        
        'medium_url', 
        'thumb_url',
        'status',         

    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];
 
}
