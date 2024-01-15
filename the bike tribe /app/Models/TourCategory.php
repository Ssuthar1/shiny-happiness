<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class TourCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [       
        'title',
        'slug', 
        'meta_title',
        'meta_tag_keywords',
        'meta_tag_descriptions',
        'short_description',
        'description',
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

    public function getTours(){
        return $this->hasMany(Tour::class,'tour_category_id','id');
    }
}
