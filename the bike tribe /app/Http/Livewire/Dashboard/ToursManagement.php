<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\User;
use App\Models\Tour;
use App\Models\TourCategory;
use App\Models\Destination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;  
use Livewire\WithPagination;
use Illuminate\Auth\Events\Registered;
use App\Rules\UniqueEmailWithSoftDelete;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\ImageInfo;
use Livewire\WithFileUploads;
use App\Traits\UploadTraits;
use Session;

class ToursManagement extends Component
{
	use WithPagination,WithFileUploads,UploadTraits;

	public $s; 
    protected $queryString = ['s'];
 
    public  $tour_id,$title,$meta_title,$meta_tag_keywords,$meta_tag_descriptions,$short_description, $description,$status;
    public $tour_category_id,$tour_code,$tour_duration,$start_price,$tour_type,$included=[],$excluded,$includesLength=1,$excludesLength=1;
    public $destinations=[],$tourCategories=[];
    public $module_title='Tour',$buttonText='';
    public $isloading=true;
 
    public $updateMode = false;
    public $mode = 'list';

    public $featured_image_url,$photo;     
    public $gallery,$gallery_images;

    protected $rules = [ 
        'title' => 'required',
        'tour_category_id'=> 'required',
        'meta_title' => '',
        'meta_tag_keywords' => '',
        'meta_tag_descriptions' => '',
        'tour_code' => 'required',
        'tour_duration' => 'required',
        'start_price' => 'required',
        'tour_type' => 'required',
        'short_description' => '',
        'description' => '',
        'status' => '',
        'photo' => 'nullable|image|max:5000', 
        'gallery.*' => 'nullable|image|max:5000',
       
    ];
    protected $messages = [
        'title.required' => ' Title is required.', 
        'tour_code.required' => 'Tour Code is required.', 
        'tour_duration.required' => 'Tour Duration is required.', 
        'start_price.required' => 'Tour Start Price is required.', 
        'tour_type.required' => 'Select Tour Type.', 
    ];

    public function mount()
    {
        $this->isloading=true;
        $this->tourCategories = TourCategory::where('status',1)->get();
        $this->destinations = Destination::where('status',1)->get();
    }
    public function render()
    {         
        $data  = Tour::where('title', 'like', '%'.$this->s.'%')->orWhere('description', 'like', '%'.$this->s.'%');
        $data = $data->orderby('id','DESC')->paginate(10);
        $this->isloading=false;
        return view('livewire.dashboard.tours.index',compact('data'));
    }
    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024',
        ]);
    }
 

    public function updatedGallery()
    {
        $this->validate([
            'gallery.*' => 'image|max:1024',
        ]);
    }
    public function increaseIncludes()
    {
        $this->includesLength = $this->includesLength+1;
    }
    public function deleteIncludes($key)
    {
        if (array_key_exists($key, $this->included)) {
            unset($this->included[$key]);
        }
    }
    public function increaseExcludes()
    {
        $this->excludesLength = $this->excludesLength+1;
    }

    private function resetInputFields(){
        $this->title = '';
        $this->tour_category_id = '';
        $this->meta_title = '';
        $this->meta_tag_keywords = '';
        $this->meta_tag_descriptions = '';
        $this->short_description = '';
        $this->description = '';
        $this->status = '';    
        $this->featured_image_url = '';  
        $this->gallery=array();    
        $this->mode = 'list'; 
        $this->reset('tour_code','tour_duration','start_price','tour_type','included','excluded','includesLength','excludesLength');
    }

    public function add()
    {
        $this->mode = 'add'; 
    }
    public function store()
    {
        $validatedData = $this->validate(); 
        if(empty($this->status))
        {
            $this->status = 1;
        }
        $this->setMetaValue();
        $data = array();
        $data['title']                  = $this->title;
        $data['tour_category_id']       = $this->tour_category_id;
        $data['meta_title']             = $this->meta_title;
        $data['meta_tag_keywords']      = $this->meta_tag_keywords;
        $data['meta_tag_descriptions']  = $this->meta_tag_descriptions;
        $data['short_description']      = substr($this->short_description, 0, 255); 
        $data['tour_code']              = $this->tour_code;
        $data['tour_duration']          = $this->tour_duration;
        $data['included']               = json_encode($this->included);
        $data['excluded']               = json_encode($this->excluded);
        $data['start_price']            = $this->start_price;
        $data['tour_type']              = $this->tour_type; 
        $data['description']            = $this->description;
        $data['status']                 = $this->status; 
  
        $dataInfo = Tour::create($data);
        $id = $dataInfo->id;
        if(!empty($validatedData['photo']))
        {
           $this->saveImage($validatedData['title'],$validatedData['photo'],'tour',$id);             
        }
 
        if(!empty($validatedData['gallery']))
        {
            foreach($validatedData['gallery'] as $galleryImage)
            {
                $this->saveImage($validatedData['title'],$galleryImage,'tour',$id,'gallery_image');
            }
        } 
         
        $this->dispatchBrowserEvent('successMessage', [ 
                    'message' => __("Tour Created Successfully."), 
                ]);
        $this->resetInputFields();
    }

     public function edit($id)
    {   
        $editInfo = Tour::findOrFail($id);
        $this->tour_id = $id;
        $this->title = $editInfo->title;
        $this->tour_category_id = $editInfo->tour_category_id;
        $this->meta_title = $editInfo->meta_title;
        $this->meta_tag_keywords = $editInfo->meta_tag_keywords;
        $this->meta_tag_descriptions = $editInfo->meta_tag_descriptions;
        $this->short_description = $editInfo->short_description;

        $this->tour_code = $editInfo->tour_code;
        $this->tour_duration = $editInfo->tour_duration;
        $this->start_price = $editInfo->start_price;
        $this->tour_type = $editInfo->tour_type;
        if(!empty($editInfo->included))
        {
            $this->included = json_decode($editInfo->included);
            if(is_array($this->included))
            {
                $this->includesLength = count($this->included);
            } 
        }
        if(!empty($editInfo->excluded))
        {
            $this->excluded = json_decode($editInfo->excluded);
            if(is_array($this->excluded))
            {
             $this->excludesLength = count($this->excluded);
            }
        }

        $this->description = $editInfo->description;
        $this->status = $editInfo->status;
        $this->updateMode = true;
        $this->mode = 'edit';
        if(isset($editInfo->mainImage->imageUrls->image_url))
        {
            $this->featured_image_url = $editInfo->mainImage->imageUrls->image_url;
        } 
        if(isset($editInfo->galleryImages))
        {
            foreach($editInfo->galleryImages as $galleryImage)
            {
                $this->gallery_images[$galleryImage->id] = $galleryImage->imageUrls->image_url;
            }
             
        }

    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->mode = 'list';
        $this->resetInputFields();
    }

     public function update()
    {
         $data['included']               = json_encode($this->included);
        $data['excluded']               = json_encode($this->excluded);

        $this->validate(); 
        $data = Tour::find($this->tour_id);
        $data->update([
            'title'                 => $this->title,
            'tour_category_id'      => $this->tour_category_id,
            'meta_title'            => $this->meta_title,
            'meta_tag_keywords'     => $this->meta_tag_keywords,
            'meta_tag_descriptions' => $this->meta_tag_descriptions,
            'short_description'     => substr($this->short_description, 0, 255), 
            'tour_code'             => $this->tour_code,
            'tour_duration'         => $this->tour_duration,
            'included'              => json_encode($this->included),
            'excluded'              => json_encode($this->excluded),
            'start_price'           => $this->start_price,
            'tour_type'             => $this->tour_type, 
            'description'           => $this->description,
            'status'                => $this->status,
        ]);
         $id = $this->tour_id;
        if(!empty($validatedData['photo']))
        {
            if(isset($data->mainImage))
            {
                ImageInfo::where('id',$data->mainImage->id)->delete();
            }
           $this->saveImage($validatedData['title'],$validatedData['photo'],'tour',$id); 

        }
 
  
        if(!empty($validatedData['gallery']))
        {
            foreach($validatedData['gallery'] as $galleryImage)
            {
                $this->saveImage($validatedData['title'],$galleryImage,'tour',$id,'gallery_image');
            }
        }
        $this->updateMode = false; 
        $this->dispatchBrowserEvent('successMessage', [ 
                    'message' => __("Tour Updated Successfully."), 
                ]);
        $this->resetInputFields();
    }

   public function changeStatus($id){
        $status = Tour::find($id);
        // dd($status->status);
        if ($status['status'] == '1') {
            $status->update(['status'=>'0']);
        }else{
            $status->update(['status'=>'1']);
        } 
        $this->dispatchBrowserEvent('successMessage', [ 
                    'message' => __("Status Updated Successfully."), 
                ]);
    }

    public function delete($id)
    {
        Tour::find($id)->delete(); 
        $this->dispatchBrowserEvent('successMessage', [ 
                    'message' => __("Tour Deleted Successfully."), 
                ]);
    }
     public function deleteImage($id)
    {
        ImageInfo::find($id)->delete();
        unset($this->gallery_images[$id]);
        $this->dispatchBrowserEvent('successMessage', [ 
                    'message' => __("Image Deleted Successfully."), 
                ]);           
    }

   public function setMetaValue(){

        if(empty($this->meta_title))
        {
            $this->meta_title               = $this->title;
        }
        if(empty($this->meta_tag_keywords))
        { 
            $this->meta_tag_keywords        = $this->title;
        }   
        if(empty($this->meta_tag_descriptions))
        { 
            $this->meta_tag_descriptions    = $this->title;
        } 
    }
    
}
 