<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\User;
use App\Models\Testimonial;
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

class TestimonialManagement extends Component
{
	use WithPagination,WithFileUploads,UploadTraits;

	public $s; 
    protected $queryString = ['s'];
 
    public  $testimonial_id,$title,$meta_title,$meta_tag_keywords,$meta_tag_descriptions,$short_description, $description,$status;
    public $module_title='testimonial',$buttonText='';
    public $isloading=true;
 
    public $updateMode = false;
    public $mode = 'list';

    public $featured_image_url,$photo;     
    public $gallery,$gallery_images;

    public function mount()
    {
        $this->isloading=true;
    }
    public function render()
    {         
        $data  = Testimonial::where('title', 'like', '%'.$this->s.'%')->orWhere('description', 'like', '%'.$this->s.'%');
        $data = $data->orderby('id','DESC')->paginate(10);
        $this->isloading=false;
        return view('livewire.dashboard.testimonials.index',compact('data'));
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
        $validatedData = $this->validate([
            'title' => 'required',
            'meta_title' => 'required',
            'meta_tag_keywords' => '',
            'meta_tag_descriptions' => '',
            'short_description' => '',
            'description' => '',
            'status' => '',
            'photo' => 'nullable|image|max:5000', 
            'gallery.*' => 'nullable|image|max:5000',
        ]);
  
        $dataInfo = Testimonial::create($validatedData);
        $id = $dataInfo->id;
        if(!empty($validatedData['photo']))
        {
           $this->saveImage($validatedData['title'],$validatedData['photo'],'testimonial',$id);             
        }
 
        if(!empty($validatedData['gallery']))
        {
            foreach($validatedData['gallery'] as $galleryImage)
            {
                $this->saveImage($validatedData['title'],$galleryImage,'testimonial',$id,'gallery_image');
            }
        }
  
        session()->flash('message', 'Destination Category Created Successfully.');
  
        $this->resetInputFields();
    }

     public function edit($id)
    {
        $editInfo = Testimonial::findOrFail($id);
        $this->testimonial_id = $id;
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
        $validatedData = $this->validate([
            'title' => 'required',
            'meta_title' => 'required',
            'meta_tag_keywords' => '',
            'meta_tag_descriptions' => '',
            'short_description' => '',
            'description' => '',
            'status' => '',
            'photo' => 'nullable|image|max:5000', 
            'gallery.*' => 'nullable|image|max:5000',
        ]);
  
        $data = Testimonial::find($this->testimonial_id);
        $data->update([
            'title' => $this->title,
            'meta_title' => $this->meta_title,
            'meta_tag_keywords' => $this->meta_tag_keywords,
            'meta_tag_descriptions' => $this->meta_tag_descriptions,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'status' => $this->status,
        ]);
         $id = $this->testimonial_id;
        if(!empty($validatedData['photo']))
        {
            if(isset($data->mainImage))
            {
                ImageInfo::where('id',$data->mainImage->id)->delete();
            }
           $this->saveImage($validatedData['title'],$validatedData['photo'],'testimonial',$id); 

        }
 
  
        if(!empty($validatedData['gallery']))
        {
            foreach($validatedData['gallery'] as $galleryImage)
            {
                $this->saveImage($validatedData['title'],$galleryImage,'testimonial',$id,'gallery_image');
            }
        }
        $this->updateMode = false;
  
        session()->flash('message', 'Destination Updated Successfully.');
        $this->resetInputFields();
    }

   public function changeStatus($id){
        $status = Testimonial::find($id);
        // dd($status->status);
        if ($status['status'] == '1') {
            $status->update(['status'=>'0']);
        }else{
            $status->update(['status'=>'1']);
        }
        session()->flash('message', 'Status Updated Successfully.');
    }

    public function delete($id)
    {
        Testimonial::find($id)->delete();
        session()->flash('message', 'Destination Category Deleted Successfully.');
    }
     public function deleteImage($id)
    {
        ImageInfo::find($id)->delete();
        unset($this->gallery_images[$id]);
        session()->flash('imageDeleteMessage', 'Image Deleted.');        
    }

    public function metaValue(){
        $this->meta_title               = $this->title;
        $this->meta_tag_keywords        = $this->title;
        $this->meta_tag_descriptions    = $this->title;
        $this->short_description        = $this->title;
    }
}
 