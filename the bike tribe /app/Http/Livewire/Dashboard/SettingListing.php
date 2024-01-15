<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Setting;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Traits\UploadTraits;
use Carbon\Carbon;
use Auth;

class SettingListing extends Component
{
    use WithPagination,UploadTraits,WithFileUploads;
    public $option_key,$option_name,$option_value,$updateId = '',$option_type_file,$special_option = [],$checkBoxValues = [];
    public $option_type;
    public $pageType = 'index';
    
    public function render()
    {
        $data = Setting::where('is_hide',0)->orderBy('option_name','ASC')->paginate(20);
        return view('livewire.dashboard.settings.index',compact('data'));
    }


    public function edit($id){
        $this->updateId = $id;
        $setting = Setting::find($id);
        $this->option_key   = $setting->option_key;
        $this->option_name  = $setting->option_name;
        $this->option_type  = $setting->option_type;
        if ($setting->option_type == 'file') {
            $this->option_type_file = $setting->option_value;
        }elseif($setting->option_type == 'select'){
            $this->special_option = explode('|',$setting->special_option);
            $this->option_value = $setting->option_value;
        }elseif($setting->option_type == 'video'){
            $this->option_type_file = $setting->option_value;
        }elseif($setting->option_type == 'audio'){
            $this->option_type_file = $setting->option_value;
        }elseif($setting->option_type == 'radio'){
            $this->special_option = explode('|',$setting->special_option);
            $this->option_value = $setting->option_value;
        }elseif($setting->option_type == 'checkbox'){
            $this->special_option = explode('|',$setting->special_option);
            $this->checkBoxValues = explode(',', $setting->option_value);
        }else{
            $this->option_value = $setting->option_value;
        }
        $this->pageType = 'edit';
    }

    /**
     * Update the user's profile information.
     */
    public function update()
    {
        if ($this->option_type != 'checkbox') {
            $this->validate([
                'option_value'  => (!empty($this->option_type_file)) ? 'nullable' : 'required',
                ],[
                    'option_value.required' => $this->option_name.' is required',
                ]
            );
        }else{
            $this->validate([
                'checkBoxValues'  => 'required',
                ],[
                    'checkBoxValues.required' => $this->option_name.' is required',
                ]
            );
        }
        if (isset($this->option_type) && $this->option_type == 'file') {
            if (isset($this->option_value) && !empty($this->option_value)) {
                $option_value = $this->option_value->store('public');
            }else{
                $option_value = $this->option_type_file;
            }
        }elseif(isset($this->option_type) && $this->option_type == 'video'){

            if (isset($this->option_value) && !empty($this->option_value)) {
                $option_value = $this->option_value->store('public');
            }else{
                $option_value = $this->option_type_file;
            }

        }elseif(isset($this->option_type) && $this->option_type == 'audio'){
            
            if (isset($this->option_value) && !empty($this->option_value)) {
                $option_value = $this->option_value->store('public');
            }else{
                $option_value = $this->option_type_file;
            }

        }elseif(isset($this->option_type) && $this->option_type == 'checkbox'){
            $option_value =  implode(',', $this->checkBoxValues);

        }else{
            $option_value = $this->option_value;
        }
        Setting::where('id',$this->updateId)->update(['option_value'=>$option_value]);
        $this->cancel();
        return session()->flash('success', 'Setting update successfully.');

    }

    public function cancel(){
        $this->reset('option_type','option_name','option_key','option_value','updateId');
        $this->pageType = 'index';
    }
}
