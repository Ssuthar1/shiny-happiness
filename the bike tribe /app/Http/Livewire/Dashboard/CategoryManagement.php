<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Category;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Traits\UploadTraits;
use Carbon\Carbon;
use Auth ,Config;

class CategoryManagement extends Component
{
    use WithPagination,UploadTraits,WithFileUploads;
    public $startDate = '',$endDate = '',$s,$parent_id,$name,$updateId = '',$slug,$image,$status=1,$parentCategory = [],$buttonText = "Update";
    protected $queryString = ['s'];
    public $pageType = 'index';
    public function mount(){
        // $this->startDate = Carbon::now()->subDays(5)->startOfDay()->format('Y-m-d');
        // $this->endDate = Carbon::now()->endOfDay()->format('Y-m-d');
        $this->parentCategory = Category::whereNull('parent_id')->where('status',1)->latest()->get(); 
    }
    
    public function render()
    {
        $userInfo = Auth::user();
        $data = [];
        // if (!empty($this->startDate) && !empty($this->endDate)) {
            // $startTime = $this->startDate.' 00:00:00';
            // $endTime = $this->endDate.' 23:59:59';
            $data = Category::orderBy('id','DESC');
            if (!empty($this->s)) {
                $data = $data->where('name',trim($this->s));
            }
            $data = $data->with('getParentCategory')->paginate(10);
        // }
        return view('livewire.dashboard.categorys.index',compact('data'));
    }

    public function addCategory(){
        $this->pageType             = 'edit';
        $this->buttonText           = 'Save';
    }


    public function edit($id){
        $this->updateId = $id;
        $setting = Category::find($id);
        $this->parent_id                = $setting->parent_id;
        $this->name                     = $setting->name;
        $this->oldImage                 = $setting->image;
        $this->status                   = $setting->status;
        $this->slug                     = $setting->slug;
        $this->pageType                 = 'edit';
    }

    public function cancel(){
        $this->reset('updateId','parent_id','name','image','status','slug','pageType','buttonText');
        $this->resetValidation();
    }

    public function update(){

        $this->validate([
                'name'      => 'required',
                'image'     => (isset($this->oldImage) && !empty($this->oldImage)) ? 'nullable' :'required',
                'status'    => 'required',
            ],
            [
                'name.required'     => 'Name field is required',
                'image.required'    => 'Image field is required',
                'status.required'   => 'Please select a status',
            ]
        );
        $image = '';
        if(isset($this->image) && !empty($this->image)){
            $image = $this->image->store('public');
        }else{
            $image = $this->oldImage;
        }
        $data['parent_id']              = $this->parent_id;
        $data['name']                   = $this->name;
        $data['image']                  = $image;
        $data['status']                 = $this->status;
        Category::updateOrCreate(['id'=>$this->updateId],$data);
        $this->cancel();

        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'success',  
            'message' => __("Category Save successfully."),
            'text' => __("Category Save successfully."),
        ]);
        
        return session()->flash('success', 'Category Save successfully.');
    }

    
    public function updateStatus($action,$id)
    {
        Category::where('id',$id)->update(['status'=>$action]);
         
        $this->dispatchBrowserEvent('swal:success', [
                    'icon' => 'success',  
                    'title' => __("Success"),
                    'text' => __("Category status updated successfully."), 
                ]);
    }

    public function deleteCategory($id){
        if (!empty($id)) {
            $delete = Category::where('id',$id)->delete();
            return session()->flash('success', 'Category delete successfully.');
        }
    }

}