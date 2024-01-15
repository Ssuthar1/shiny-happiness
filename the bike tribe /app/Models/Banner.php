<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{ 
    use HasFactory,SoftDeletes; 

    protected $fillable = [    
        'title',
        'sub_title',
        'description',    
        'image',          
        'link_text',    
        'link_url',  
        'banner_location', /// Select dropdown ('Main Banner','Home Middle Small Banner','Home Bottom Banner')    
        'status',     
        
    ];

    protected $guarded = ['id', 'created_at', 'updated_at']; 
      
}
