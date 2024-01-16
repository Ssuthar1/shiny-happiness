<?php

namespace App\Http\Livewire\Frontend\Old;

use Livewire\Component;
use App\Models\Booking;
use App\Models\User;
use App\Models\PaymentInformation;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Traits\UploadTraits;
use Carbon\Carbon;
use Auth ,Config;

class BookingComponent extends Component
{
    use WithPagination,UploadTraits,WithFileUploads;
    public $booking_id,$booking_amount,$plan_id,$updateId = '',$booking_name,$address,$start_date,$end_date,$start_time=1,$end_time=1,$name,$email,$mobile_no,$status,$plan_description,$booking_for,$planList=[],$bookingTime=[];
    public $step='1',$oneHoureAmount = 1000;
    public function mount(){
        $this->planList = Config::get('global.planInfo');
        $this->bookingTime = Config::get('global.bookingTime');
    }
    
    public function render()
    {
        return view('livewire.frontend.booking');
    }

    public function cancel(){
        $this->reset('booking_id','updateId','booking_amount','plan_id','start_date','end_date','start_time','end_time','name','email','mobile_no','status','step','plan_description','booking_for','address','booking_name');
        $this->pageType = 'index';
    }

    public function next(){

        $this->validate([
                'plan_id'  => 'required',
                'start_date'  => 'required',
                'end_date'  => 'required',
                'start_time'  => 'required',
                'end_time'  => 'required',
            ],
            [
                'plan_id.required' => 'Please select a plan',
                'start_date.required' => 'Please select start date',
                'end_date.required' => 'Please select end date',
                'start_time.required' => 'Please select start time',
                'end_time.required' => 'Please select end time',
            ]
        );
        if (!empty($this->start_time) && !empty($this->end_time)) {
            $time1 = $this->start_time + 4;
            if ($time1 > $this->end_time) {
                return session()->flash('error', 'It is mandatory to have a gap of 2 hours between start time and end time.');
            }
        }
        $this->step='2';
    }

    public function back(){
        $this->step='1';
    }

    /**
     * Update the user's profile information.
     */
    public function update()
    {
        $this->validate([
                'name'  => 'required',
                'booking_name'  => 'required',
                'email'  => 'required|email',
                'mobile_no'  => 'required',
                'plan_id'  => 'required',
                'start_date'  => 'required',
                'address'  => 'required',
                'end_date'  => 'required',
                'start_time'  => 'required',
                'end_time'  => 'required',
            ],
            [
                'name.required' => 'Name field is required',
                'email.required' => 'Email field is required',
                'booking_name.required' => 'Booking Name field is required',
                'mobile_no.required' => 'Mobile Number field is required',
                'plan_id.required' => 'Please select a plan',
                'start_date.required' => 'Please select start date',
                'address.required' => 'Address field is required',
                'end_date.required' => 'Please select end date',
                'start_time.required' => 'Please select start time',
                'end_time.required' => 'Please select end time',
            ]
        );

        if (!empty($this->start_time) && !empty($this->end_time)) {
            $time1 = $this->start_time + 4;
            if ($time1 > $this->end_time) {
                return session()->flash('error', 'It is mandatory to have a gap of 2 hours between start time and end time.');
            }
        }

        $data                       = [];
        $data['booking_id']         = $this->bookingNUmber();
        $data['plan_id']            = $this->plan_id;
        $data['booking_name']       = $this->booking_name;
        $data['address']            = $this->address;
        $data['booking_for']        = $this->booking_for;
        $data['start_date']         = $this->start_date;
        $data['end_date']           = $this->end_date;
        $data['start_time']         = $this->bookingTime[$this->start_time];
        $data['end_time']           = $this->bookingTime[$this->end_time];
        $data['name']               = $this->name;
        $data['email']              = $this->email;
        $data['mobile_no']          = $this->mobile_no;
        $data['plan_description']   = $this->plan_description;
        $data['booking_amount']     = $this->booking_amount;
        Booking::updateOrCreate(['id'=>$this->updateId],$data);
        $this->cancel();

        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'success',  
            'message' => __("Booking Create successfully."),
            'text' => __("Booking Create successfully."),
        ]);
        return session()->flash('success', 'Booking Create successfully.');

    }

    public function bookingNUmber(){
         do
        {
            $uid=rand('11111111','99999999');
            $booking_id='KGMI'.$uid;
            $booking=Booking::select('booking_id')->where('booking_id',$booking_id)->first();
        }
        while($booking !== null);  
        return $booking_id;
    }

    public function getTotalAmount(){
        if (!empty($this->start_date) && !empty($this->end_date)) {
            $datetime1 = strtotime($this->start_date); 
            $datetime2 = strtotime($this->end_date); 
            $days = (int)((($datetime2 - $datetime1)/86400));
            $totalDays = $days+1;
            if (!empty($this->start_time) && !empty($this->end_time)) {
                $hours = ($this->end_time - $this->start_time)/2;
                $total = ($hours * $this->oneHoureAmount) * $totalDays;
                if ($total > 0) {
                    $this->booking_amount = $total;
                }
            }
        }

        if (!empty($this->start_time) && !empty($this->end_time)) {
            $time1 = $this->start_time + 4;
            if ($time1 > $this->end_time) {
                session()->flash('error', 'It is mandatory to have a gap of 2 hours between start time and end time.');
            }
        }
    }
}