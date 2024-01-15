<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\User;
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

class DestinationsManagement extends Component
{
	use WithPagination,WithFileUploads,UploadTraits;

	public $s; 
    protected $queryString = ['s'];
 
    public  $destination_id,$title,$meta_title,$meta_tag_keywords,$meta_tag_descriptions,$short_description, $description,$status;
    public $module_title='Destination',$buttonText='';
    public $isloading=true;
 
    public $updateMode = false;
    public $mode = 'list';

    public $featured_image_url,$photo;     
    public $gallery,$gallery_images;

    protected $rules = [ 
        'title' => 'required',
        'meta_title' => '',
        'meta_tag_keywords' => '',
        'meta_tag_descriptions' => '',
        'short_description' => '',
        'description' => '',
        'status' => '',
        'photo' => 'nullable|image|max:5000', 
        'gallery.*' => 'nullable|image|max:5000',
       
    ];
    protected $messages = [
        'title.required' => ' Title is required.', 
    ];

    public function mount()
    {
        $this->isloading=true;
    }
    public function render()
    {         
        $data  = Destination::where('title', 'like', '%'.$this->s.'%')->orWhere('description', 'like', '%'.$this->s.'%');
        $data = $data->orderby('id','DESC')->paginate(10);
        $this->isloading=false;

        return view('livewire.dashboard.destinations.index',compact('data'));
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

    private function resetInputFields(){
        $this->title = '';
        $this->meta_title = '';
        $this->meta_tag_keywords = '';
        $this->meta_tag_descriptions = '';
        $this->short_description = '';
        $this->description = '';
        $this->status = '';    
        $this->featured_image_url = '';  
        $this->gallery=array();    
        $this->mode = 'list';
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
        $data['meta_title']             = $this->meta_title;
        $data['meta_tag_keywords']      = $this->meta_tag_keywords;
        $data['meta_tag_descriptions']  = $this->meta_tag_descriptions;
        $data['short_description']      = substr($this->short_description, 0, 255);
        $data['description']            = $this->description;
        $data['status']                 = $this->status; 
  
        $dataInfo = Destination::create($data);
        $id = $dataInfo->id;
        if(!empty($validatedData['photo']))
        {
           $this->saveImage($validatedData['title'],$validatedData['photo'],'destination',$id);             
        }
 
        if(!empty($validatedData['gallery']))
        {
            foreach($validatedData['gallery'] as $galleryImage)
            {
                $this->saveImage($validatedData['title'],$galleryImage,'destination',$id,'gallery_image');
            }
        } 
         
        $this->dispatchBrowserEvent('successMessage', [ 
                    'message' => __("Destination Created Successfully."), 
                ]);
        $this->resetInputFields();
    }

     public function edit($id)
    {
        $editInfo = Destination::findOrFail($id);
        $this->destination_id = $id;
        $this->title = $editInfo->title;
        $this->meta_title = $editInfo->meta_title;
        $this->meta_tag_keywords = $editInfo->meta_tag_keywords;
        $this->meta_tag_descriptions = $editInfo->meta_tag_descriptions;
        $this->short_description = $editInfo->short_description;
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
        $this->validate();
  
        $data = Destination::find($this->destination_id);
        $data->update([
            'title' => $this->title,
            'meta_title' => $this->meta_title,
            'meta_tag_keywords' => $this->meta_tag_keywords,
            'meta_tag_descriptions' => $this->meta_tag_descriptions,
            'short_description' => substr($this->short_description, 0, 255),
            'description' => $this->description,
            'status' => $this->status,
        ]);
         $id = $this->destination_id;
        if(!empty($validatedData['photo']))
        {
            if(isset($data->mainImage))
            {
                ImageInfo::where('id',$data->mainImage->id)->delete();
            }
           $this->saveImage($validatedData['title'],$validatedData['photo'],'destination',$id); 

        }
 
  
        if(!empty($validatedData['gallery']))
        {
            foreach($validatedData['gallery'] as $galleryImage)
            {
                $this->saveImage($validatedData['title'],$galleryImage,'destination',$id,'gallery_image');
            }
        }
        $this->updateMode = false; 
        $this->dispatchBrowserEvent('successMessage', [ 
                    'message' => __("Destination Updated Successfully."), 
                ]);
        $this->resetInputFields();
    }

   public function changeStatus($id){
        $status = Destination::find($id);
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
        Destination::find($id)->delete(); 
        $this->dispatchBrowserEvent('successMessage', [ 
                    'message' => __("Destination Deleted Successfully."), 
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
 