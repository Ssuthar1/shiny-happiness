<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Destination extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [ 
     	'destination_category_id', 
        'title',
        'slug',
        'descriptions',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'short_description',
        'status',       
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function mainImage()
    {
         return $this->hasOne(ImageInfo::class,'property_id','id')->where('image_position','main_image');
    }
    
}
