<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Tour extends Model
{
    use HasFactory,SoftDeletes;
  //  use InteractsWithMedia;
    protected $fillable = [ 
     	'tour_category_id', 
        'title',
        'slug', 
        'meta_title',
        'meta_tag_keywords',
        'meta_tag_descriptions',
        'featured_image',
        'description',
        'tour_code',
        'destinations',
        'tour_duration',
        'itineraries',
        'included',
        'excluded',
        'extra_features',
        'start_price', 
        'tour_type',
        'status',   
        'published_at',           

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

    /*public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'blog_category_id');
    }*/

    public function tourCategory(): BelongsTo
    {
        return $this->belongsTo(TourCategory::class,'tour_category_id');
    }

    public function mainImage()
    {
         return $this->hasOne(ImageInfo::class,'property_id','id')->where('image_position','main_image');
    }
    public function getGalleryImages()
    {
         return $this->hasMany(Media::class,'model_id','id')->where('collection_name','gallery-images');
    }
    public function getItineraries()
    {
        try{


        $itineraries = explode('#staritinerary#', $this->itineraries);
        $itineraryInfo = array();
        
        if(is_array($itineraries))
        {
            foreach ($itineraries as $key => $data) {
                 $itinerariesArray = array();
                // echo $data;
                 if(!empty($data))
                 {
                    $itinerariesData = trim($data,'#title#'); 
                    if(isset($itinerariesData))
                    {
                        /* Get Title Info*/
                        $itinerariesData1 = explode('#endtitle#', $itinerariesData);
                        if(isset($itinerariesData1[0]))
                        {
                            $itinerariesArray['title'] = $itinerariesData1[0];
                          //  $itineraryInfo[] = $itinerariesArray;
                        }
                        /* Get Desc Info*/
                        $itinerariesData1 = explode('#desc#', $itinerariesData);
                        foreach($itinerariesData1 as $itinerariesData2)
                        if(isset($itinerariesData2))
                        {
                            $itinerariesData3 = explode('#enddesc', $itinerariesData2);
                            if(isset($itinerariesData3[0]))
                            {
                                $itinerariesArray['desc'] = $itinerariesData3[0];
                            }  
                           // $itineraryInfo[] = $itinerariesArray;
                        }
                        $itineraryInfo[] = $itinerariesArray;
                        #desc# 
                    } 

                 }
            }
        } 
         
        return $itineraryInfo;
    }catch(\Exception $e) {
            //$e->getMessage();
        }
    }
}
