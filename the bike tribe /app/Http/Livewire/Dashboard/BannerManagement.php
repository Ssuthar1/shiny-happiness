<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Banner;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Traits\UploadTraits;
use Carbon\Carbon;
use Auth ,Config;

class BannerManagement extends Component
{
    use WithPagination,UploadTraits,WithFileUploads;
    public $startDate = '',$endDate = '',$s,$title,$sub_title,$oldImage,$updateId = '',$image,$description,$link_text,$link_url,$banner_location,$status=1,$buttonText = "Update";
    protected $queryString = ['s','startDate','endDate'];
    public $pageType = 'index';
    public function mount(){
        // $this->startDate = Carbon::now()->startOfDay()->format('Y-m-d');
        // $this->endDate = Carbon::now()->endOfDay()->format('Y-m-d');
    }
    
    public function render()
    {
        $userInfo = Auth::user();
        $data = [];
        // if (!empty($this->startDate) && !empty($this->endDate)) {
            // $startTime = $this->startDate.' 00:00:00';
            // $endTime = $this->endDate.' 23:59:59';
            $data = Banner::orderBy('id','DESC');
            if (!empty($this->s)) {
                $data = $data->where('title', 'LIKE' , '%' . trim($this->s) . '%');
            }
            $data = $data->paginate(10);
        // }
        return view('livewire.dashboard.banner.index',compact('data'));
    }

    public function addBanner(){
        $this->pageType             = 'edit';
        $this->buttonText           = 'Save';
    }


    public function edit($id){
        $this->updateId = $id;
        $setting                   = Banner::find($id);
        $this->title               = $setting->title;
        $this->sub_title           = $setting->sub_title;
        $this->oldImage            = $setting->image;
        $this->description         = $setting->description;
        $this->link_text           = $setting->link_text;
        $this->link_url            = $setting->link_url;
        $this->banner_location     = $setting->banner_location;
        $this->status              = $setting->status;
        $this->pageType            = 'edit';
        $this->buttonText          = 'Update';
    }

    public function cancel(){
        $this->reset('updateId','title','sub_title','description','oldImage','image','link_text','link_url','banner_location','status','pageType','buttonText');
        $this->resetValidation();
    }

    public function update(){

        $this->validate([
                'title'      => 'required',
               // 'sub_title'      => 'required',
              //  'description'      => 'required',
                // 'link_text'      => 'required',
                // 'link_url'      => 'required',
                'banner_location'      => 'required',
                'image'     => (isset($this->oldImage) && !empty($this->oldImage)) ? 'nullable' :'required',
                'status'    => 'required',
            ],
            [
                'name.required'                 => 'Name field is required',
                'image.required'                => 'Image field is required',
                'status.required'               => 'Please select a status',
                'banner_location.required'      => 'Please select a banner location',
            ]
        );
        $image = '';
        if(isset($this->image) && !empty($this->image)){
            $image = $this->image->store('public');
        }else{
            $image = $this->oldImage;
        }
        $data['title']                  = $this->title;
        $data['sub_title']              = $this->sub_title;
        $data['description']            = $this->description;
        $data['link_text']              = $this->link_text;
        $data['link_url']               = $this->link_url;
        $data['banner_location']        = $this->banner_location;
        $data['image']                  = $image;
        $data['status']                 = $this->status;
        Banner::updateOrCreate(['id'=>$this->updateId],$data);
        $this->cancel();

        $this->dispatchBrowserEvent('swal:confirm', [
            'type'      => 'success',  
            'message'   => __("Banner Save successfully."),
            'text'      => __("Banner Save successfully."),
        ]);
        
        return session()->flash('success', 'Banner Save successfully.');
    }

    
    public function updateStatus($action,$id)
    {
        Banner::where('id',$id)->update(['status'=>$action]);
         
        $this->dispatchBrowserEvent('swal:success', [
                    'icon' => 'success',  
                    'title' => __("Success"),
                    'text' => __("Banner status updated successfully."), 
                ]);
    }

    public function deleteBanner($id){
        if (!empty($id)) {
            $delete = Banner::where('id',$id)->delete();
            return session()->flash('success', 'Banner delete successfully.');
        }
    }

}