<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Product;
use App\Models\User; 
use App\Models\CartItem; 
use Carbon\Carbon;
use App\Traits\SendSms;
use Illuminate\Support\Facades\Hash;
use Auth ,Config;

class Login extends Component
{
    use SendSms;
    public $email,$mobile_no,$selected_mobile,$otp,$userOtp; 
  
    protected $listeners = ['login-account' => 'loginAccountForm'];

    public function mount(){
        
    }
    
    public function render()
    {
      	$data = array();   
        return view('livewire.frontend.login',compact('data'));
    }
    function loginAccountForm()
    {
        $this->dispatchBrowserEvent('openLoginForm', [
                    'icon' => 'success', 
                ]);
    }
    function loginUserAccount($mobile_no='')
    {

        $userInfo = User::where('mobile_no',$mobile_no)->first();
        $this->otp = rand(1000,9999);
        if($userInfo)
        {
            $userInfo->update(['otp'=>$this->otp]);
            $this->selected_mobile = $mobile_no; 
            $this->sendOTP($mobile_no,$this->otp); 
            Auth::login($userInfo);
        }else{
            $this->selected_mobile = $mobile_no; 
            $this->sendOTP($mobile_no,$this->otp);

            $userCreate = new User();
            $userCreate['name']                 = '';
            $userCreate['mobile_no']            = $mobile_no; 
            $userCreate['password']             = Hash::make($mobile_no);
            $userCreate['otp']                  = $this->otp; 
            $userCreate['status']               = 1;
            $user = $userCreate->save();
            $userCreate->assignRole('Customer');
            $userInfo = User::where('mobile_no',$mobile_no)->first();
            Auth::login($userInfo);
        }

        $this->dispatchBrowserEvent('loginSuccess', [
                    'icon' => 'success',  
                   // 'title' => __("Success"),
                   // 'text' => __("Success : Account login successfully!"), 
                ]);
    }
    function sendOTP($mobile_no,$otp)
    {
        $this->sendMessage($mobile_no,'otp',$otp);
    }


   

    

   
}