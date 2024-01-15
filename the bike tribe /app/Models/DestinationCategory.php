<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class DestinationCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [       
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

    public function getDestinations(){
        return $this->hasMany(Destination::class,'job_category_id','id');
    }
}
