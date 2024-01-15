<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component; 
use App\Models\Subscriber;
use App\Mail\SubscriberConfirmMail;
use Mail;

class SubscriberUser extends Component
{
	public $products=array(),$email,$status,$location='inner';
	protected $rules = [ 
	   'email' => 'required|email|unique:subscribers',
   ];

   protected $messages = [
	'email.required' => 'Email is required.',
	'email.unique' => 'You have already subscribe.',
];
	public function mount()
	{ 
		//$subscribeInfo = Subscriber::where('email',$this->email)->get();
	}
    public function render()
    {
    	if($this->location=='app')
    	{
    		return view('livewire.frontend.subscribe-app');
    	}else{
    		return view('livewire.frontend.subscribe');
    	}
        
    }

	public function store()
	{
		$inputs = $this->validate();

		Subscriber::create($inputs);

		$mailInfo = [ 
                    'subject' => 'The Bike Tribe : Subscription confirmation required', 
                    'email' => $inputs['email'],
                    'emailHash' => base64_encode($inputs['email']),
                ];
                $mailObj = new SubscriberConfirmMail($mailInfo);

                // Mail::to($validatedData['email'])->send($mailObj);
                Mail::to($inputs['email'])->send($mailObj);


			$this->dispatchBrowserEvent('swal:Subscribersuccess', [
				'icon' => 'success',  
				'title' => __("Success"),
				'text' => __("You have successfully subscribed our newsletter, please check your email and confirm subscription."), 
			]); 

			$this->resetInputFields();
	}
	private function resetInputFields()
	{
        $this->email= '';  
	} 
}
