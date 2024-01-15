<?php

namespace App\Http\Livewire\Frontend\Account;

use Livewire\Component;
use App\Models\UserAddress;
use App\Models\User;  
  
use Carbon\Carbon;
use Auth ,Config;

class Address extends Component
{
     
    public $total_item,$cartTotal=0,$location; 
  

    public function mount(){
        echo "Tester";
        exit;
    }
    
    public function render()
    {
      	$data = array();   
        return view('livewire.frontend.account.address',compact('data'));
    }
    public function saveAddress()
    {
        $this->validate();
        $user_id=Auth::user()->id;
        $dbObj = new UserAddress; 
        $dbObj->user_id   = $user_id;  
        $dbObj->first_name  = $this->first_name;
        $dbObj->last_name   = $this->last_name ;
        $dbObj->email       = $this->email ;
        $dbObj->mobile      = $this->mobile ;
        $dbObj->address_line_1  = $this->address_line_1;
        $dbObj->address_line_2  = $this->address_line_2;
        $dbObj->country     = $this->country;
        $dbObj->city  = $this->city;
        $dbObj->state  = $this->state;
        $dbObj->postcode  = $this->postcode;
        $dbObj->save();
        $this->dispatchBrowserEvent('swal:addressSuccess', [
                    'icon' => 'success',  
                    'title' => __("Success"),
                    'text' => __("Address information updated successfully!"), 
                ]);

    }
   

    

   
}