<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageInfo extends Model
{
    use HasFactory,SoftDeletes; 

    protected $table = 'image_infos';

    protected $fillable = [         
        'type',
        'image_position',
        'property_id',
        'image_bank_id',   
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

     public function imageUrls()
    {
        return $this->hasOne(ImageBank::class,'id', 'image_bank_id');
    }
 
}
