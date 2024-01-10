<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Booking;
use App\Models\User;
use App\Models\PaymentInformation;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Traits\UploadTraits;
use Carbon\Carbon;
use Auth ,Config;

class BookingsListing extends Component
{
    use WithPagination,UploadTraits,WithFileUploads;
    public $startDate = '',$endDate = '',$s, $plan ,$booking_id,$booking_amount,$plan_id,$updateId = '',$booking_name,$address,$start_date,$end_date,$start_time=1,$end_time=1,$name,$email,$mobile_no,$status,$plan_description,$booking_for,$planList=[],$bookingTime=[],$team_name,$team_mobile_no,$photographer,$photographer_assistant,$cinematographer,$cinematographer_assistant,$models,$makeup_assitants,$makeup_artist,$hair_stylist,$dress_des;
    protected $queryString = ['s' , 'plan','startDate','endDate'];
    public $pageType = 'index',$step='1',$oneHoureAmount = 700;
    public function mount(){
        $this->planList = Config::get('global.planInfo');
        $this->bookingTime = Config::get('global.bookingTime');
       // $this->startDate = Carbon::now()->startOfDay()->format('Y-m-d');
       // $this->endDate = Carbon::now()->endOfDay()->format('Y-m-d');
    }
    
    public function render()
    {
        $userInfo = Auth::user();
        $total = 0;
        /* 
        if(!empty($this->startDate) && !empty($this->endDate))
        {
            $total = Booking::when(!empty($this->startDate) && !empty($this->endDate), function ($query) { 
                $startTime = $this->startDate.' 00:00:00';
                $endTime = $this->endDate.' 23:59:59';
                return $query->whereBetween('created_at', [$startTime, $endTime]);
            })
            ->sum('booking_amount');
        } */
        $data = [];
        $data = Booking::orderBy('id','DESC');
        if (!empty($this->s)) {
                $data = $data->where('booking_id',trim($this->s));
            }
            if (!empty($this->plan)) {
                $data = $data->where('plan_id',trim($this->plan));
            }
        if (!empty($this->startDate)) {
          //  $startTime = $this->startDate.' 00:00:00';
          //  $endTime = $this->endDate.' 23:59:59';
          //  $data = $data->whereBetween('created_at', [$startTime, $endTime]); 
             $data = $data->where('start_date','>=',$this->startDate);  

        }
        if (!empty($this->endDate)) {
          $data = $data->where('end_date','<=',$this->endDate);  
        }
         $data = $data->paginate(10);
        return view('livewire.dashboard.bookings.index',compact('data','total'));
    }


    public function edit($id){
        $this->updateId = $id;
        $setting = Booking::find($id);
        if (isset($this->bookingTime) && !empty($this->bookingTime)) {
            foreach ($this->bookingTime as $key => $timeValue) {
                if ($timeValue == $setting->start_time) {
                    $this->start_time   = $key;
                }
                if ($timeValue == $setting->end_time) {
                    $this->end_time   = $key;
                }
            }
        }
        $this->booking_id               = $setting->booking_id;
        $this->booking_amount           = $setting->booking_amount;
        $this->plan_id                  = $setting->plan_id;
        $this->start_date               = $setting->start_date;
        $this->end_date                 = $setting->end_date;
        $this->name                     = $setting->name;
        $this->booking_for              = $setting->booking_for;
        $this->address                  = $setting->address;
        $this->booking_name             = $setting->booking_name;
        $this->email                    = $setting->email;
        $this->mobile_no                = $setting->mobile_no;
        $this->status                   = $setting->status;
        $this->team_name                = $setting->team_name;
        $this->team_mobile_no           = $setting->team_mobile_no;
        $this->photographer_assistant   = $setting->photographer_assistant;
        $this->cinematographer          = $setting->cinematographer;
        $this->photographer             = $setting->photographer;
        $this->cinematographer_assistant  = $setting->cinematographer_assistant;
        $this->models                   = $setting->models;
        $this->makeup_assitants         = $setting->makeup_assitants;
        $this->makeup_artist            = $setting->makeup_artist;
        $this->hair_stylist             = $setting->hair_stylist;
        $this->dress_des                = $setting->dress_des;
        $this->pageType                 = 'edit';
        $this->plan_description         = $setting->plan_description;
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
    /*public function update()
    {
        $this->validate([
                'name'  => 'required',
                'email'  => 'required|email',
                'mobile_no'  => 'required',
            ],
            [
                'name.required' => 'Name field is required',
                'email.required' => 'Email field is required',
                'mobile_no.required' => 'Mobile Number field is required',
            ]
        );
        $data                       = [];
        $data['plan_id']            = $this->plan_id;
        $data['start_date']         = $this->start_date;
        $data['end_date']           = $this->end_date;
        $data['start_time']         = $this->bookingTime[$this->start_time];
        $data['end_time']           = $this->bookingTime[$this->end_time];
        $data['name']               = $this->name;
        $data['email']              = $this->email;
        $data['mobile_no']          = $this->mobile_no;
        $data['plan_description']   = $this->plan_description;
        Booking::where('id',$this->updateId)->update($data);
        $this->cancel();
        return session()->flash('success', 'Booking update successfully.');

    }*/

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
        // $data['booking_id']         = $this->bookingNUmber();
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
        $data['team_name']     = $this->team_name;
        $data['team_mobile_no']     = $this->team_mobile_no;
        $data['photographer_assistant'] = $this->photographer_assistant;
        $data['cinematographer']        = $this->cinematographer;
        $data['photographer']           = $this->photographer;
        $data['cinematographer_assistant']  = $this->cinematographer_assistant;
        $data['models']                 = $this->models;
        $data['makeup_assitants']       = $this->makeup_assitants;
        $data['makeup_artist']          = $this->makeup_artist;
        $data['hair_stylist']           = $this->hair_stylist;
        $data['dress_des']              = $this->dress_des;
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

    public function deleteBooking($id){
        if (!empty($id)) {
            $delete = Booking::where('id',$id)->delete();
            return session()->flash('success', 'Booking delete successfully.');
        }
    }


    public function getTotalAmount(){

        $this->oneHoursAmount =$this->planList[$this->plan_id]['amount'];
        
        if (!empty($this->start_date) && !empty($this->end_date)) {
            $datetime1 = strtotime($this->start_date); 
            $datetime2 = strtotime($this->end_date); 
            $days = (int)((($datetime2 - $datetime1)/86400));
            $totalDays = $days+1;
            if (!empty($this->start_time) && !empty($this->end_time)) {
                $hours = ($this->end_time - $this->start_time)/2;
                $total = ($hours * $this->oneHoursAmount) * $totalDays;
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