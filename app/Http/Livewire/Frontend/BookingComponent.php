<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Booking;
use App\Models\User;
use App\Models\PaymentInformation;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Traits\UploadTraits;
use Razorpay\Api\Api;
use Carbon\Carbon;
use Auth ,Config;

class BookingComponent extends Component
{
    use WithPagination,UploadTraits,WithFileUploads;
    public $booking_id_key,$booking_id,$booking_amount=0,$plan_id=1,$updateId = '',$booking_name,$address,$start_date,$end_date,$start_time=1,$end_time=5,$name,$email,$mobile_no,$status,$plan_description,$booking_for,$planList=[],$bookingTime=[],$pageType='bookingForm',$terms;
    public $step='1',$oneHoursAmount = 700;
    public function mount(){
        $this->planList = Config::get('global.planInfo');
        $this->bookingTime = Config::get('global.bookingTime');

        if(!empty($this->booking_id)){
            $bookingInfo = Booking::where('booking_id',$this->booking_id)->first();
            if($bookingInfo)
            {
                $this->booking_id_key = $bookingInfo->id;
                $this->booking_amount = $bookingInfo->booking_amount;
                $this->booking_name= $bookingInfo->booking_name;
                $this->email= $bookingInfo->email;
                $this->mobile_no= $bookingInfo->mobile_no;
                $this->pageType = 'bookingConfirm';
            }else{
               $this->booking_id = "Invalid"; 
            }
        }


    }
    
    public function render()
    {
        $this->getTotalAmount();
        return view('livewire.frontend.booking');
    }

    public function resetData(){
       // $this->reset('booking_id','updateId','booking_amount','plan_id','start_date','end_date','start_time','end_time','name','email','mobile_no','status','step','plan_description','booking_for','address','booking_name');
        $this->pageType = 'bookingConfirm';
    }

    public function next(){

        $this->validate([
                'plan_id'  => 'required',
                'start_date'  => 'required',
                'end_date'  => 'required',
                'start_time'  => 'required',
                'end_time'  => 'required',
              //  'terms' => 'required',
            ],
            [
                'plan_id.required' => 'Please select a plan',
                'start_date.required' => 'Please select start date',
                'end_date.required' => 'Please select end date',
                'start_time.required' => 'Please select start time',
                'end_time.required' => 'Please select end time',
              //  'terms.required' => 'Please read terms & condition and accepts.',
            ]
        );
        if (!empty($this->start_time) && !empty($this->end_time)) {
            $time1 = $this->start_time + 4;
            if ($time1 > $this->end_time) {
                return session()->flash('error', 'Minimum booking time allowed is 2 hours.');
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
    public function bookNow()
    {
        $this->validate([
                //'name'  => 'required',
                'booking_name'  => 'required',
                'email'  => 'required|email',
                'mobile_no'  => 'required',
                'plan_id'  => 'required',
                'start_date'  => 'required',
                'address'  => 'required',
                'end_date'  => 'required',
                'start_time'  => 'required',
                'end_time'  => 'required',
                'terms' => 'required',
            ],
            [
              //  'name.required' => 'Name field is required',
                'email.required' => 'Email field is required',
                'booking_name.required' => 'Booking Name field is required',
                'mobile_no.required' => 'Mobile Number field is required',
                'plan_id.required' => 'Please select a plan',
                'start_date.required' => 'Please select start date',
                'address.required' => 'Address field is required',
                'end_date.required' => 'Please select end date',
                'start_time.required' => 'Please select start time',
                'end_time.required' => 'Please select end time',
                'terms.required' => 'Please read terms & condition and accepts.',
            ]
        );

        if ( $this->start_date > $this->end_date) {
            
             return session()->flash('dateerror', 'Start date should not be greater than end date.');
        }

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
        $data['name']               = $this->booking_name;
        $data['email']              = $this->email;
        $data['mobile_no']          = $this->mobile_no;
        $data['plan_description']   = $this->plan_description;
        $data['booking_amount']     = $this->booking_amount;
        $bookingInfo = Booking::updateOrCreate(['id'=>$this->updateId],$data);

        $this->booking_id = $data['booking_id'];
        $this->booking_id_key = $bookingInfo->id;

        $this->resetData();
        
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'success',  
            'message' => __("Booking enquiry created successfully."),
            'text' => __("We will get back to you for confirmation."),
        ]);
        return session()->flash('success', 'Booking processed successfully.');

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
    public function payNow()
    {
        $totalPayment = $this->booking_amount * 100;  
        $name = $this->booking_name;
        $email = $this->email;
        $mobile_number = $this->mobile_no;

        $api = new Api(Config::get('global.razor_key'), Config::get('global.razor_secret'));
        $RazorpayResponse = $api->order->create(array('receipt' => rand(1000,9999), 'amount' => $totalPayment, 'currency' => 'INR', 'notes'=> array('name'=> $name,'email'=> $email,'mobile_number'=> $mobile_number,'booking_id'=> $this->booking_id)));

        if(isset($RazorpayResponse->id))
        {
            $order_id = $RazorpayResponse->id;

            $data                       = [];
            $data['booking_id']         =  $this->booking_id_key;
            $data['amount']             =   $this->booking_amount;
            $data['transaction_date']   = date('Y-m-d');
            $data['transaction_id']     = $order_id;
            $data['payment_information']= NULL;
            $data['status']         = 'Pending'; 
            PaymentInformation::create($data);

           // Order::where('id',$orderInfo->id)->update(['order_id' => $order_id]);

            $this->dispatchBrowserEvent('bookingPayment', [
                    'name' => $name,  
                    'email' => $email, 
                    'mobile_no' => $mobile_number, 
                    'order_id' => $order_id, 
                    'totalPayment' => $totalPayment, 
                ]);
        }
    }
}