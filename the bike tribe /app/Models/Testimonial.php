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
        'descriptions', 
        'name',
        'designation',
        'image',
        'status',              

    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
