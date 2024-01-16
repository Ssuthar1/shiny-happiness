<?php

namespace App\Http\Livewire\Frontend\Old;

use Livewire\Component;
use App\Models\Product;
use App\Models\User; 
use App\Models\CartItem; 
use App\Models\Order; 
use App\Models\OrderItem; 
use Carbon\Carbon;
use Auth ,Config;
use Razorpay\Api\Api;

class CheckoutComponent extends Component
{ 

    public $user_id,$session_id,$cartTotal=0,$cartGrandTotal=0,$total_quantity=0,$deliveryCharge=40,$discount=0,$payment_method='cod',$same_shipping,$taxPer=5,$total_tax=0,$total_item ;
    public $billing_first_name,$billing_last_name,$billing_email,$billing_mobile,$billing_address_line_1,$billing_address_line_2,$billing_country="India",$billing_city,$billing_state,$billing_postcode;
    public $shipping_first_name,$shipping_last_name,$shipping_email,$shipping_mobile,$shipping_address_line_1,$shipping_address_line_2,$shipping_country="India",$shipping_city,$shipping_state,$shipping_postcode,$shipping_postcode_error,$terms;
  //  protected $listeners = ['refresh-cart' => 'refreshCart'];

    protected $rules = [
       /* 'billing_first_name'        => 'required',
      //  'billing_last_name'           => 'required',
        'billing_email'             => 'required|email',
        'billing_mobile'            => 'integer|required|digits:10',
        'billing_address_line_1'    => 'required|max:50',
        'billing_address_line_2'    => 'max:50',
        'billing_country'           => 'required|max:50',
        'billing_city'              => 'required|max:50',
        'billing_state'             => 'required|max:50',
        'billing_postcode'          => 'required|max:6',*/

        'shipping_first_name'       => 'required',
      //  'shipping_last_name'        => 'required',
        'shipping_email'            => 'required',
        'shipping_mobile'           => 'required|integer|digits:10',
        'shipping_address_line_1'   => 'required|max:50',
        'shipping_address_line_2'    => 'max:50',
        'shipping_country'          => 'required|max:50',
        'shipping_city'             => 'required|max:50',
        'shipping_state'            => 'required|max:50',
        'shipping_postcode'         => 'required|max:6',
        'terms'                     => 'required',
       
    ];
     protected $messages = [
        'billing_first_name.required' => 'First Name is required.',
        'billing_email.required' => 'Email is required.',
        'billing_mobile.required' => 'Mobile No is required.',
        'billing_mobile.digits'=> 'Mobile no should contains 10 digits.',
        'billing_address_line_1.required' => 'Address is required.',
        'billing_country.required' => 'Country is required.',
        'billing_city.required' => 'City is required.',
        'billing_state.required' => 'State is required.',
        'billing_postcode.required' => 'Postcode is required.',

        'shipping_first_name.required' => 'First Name is required.',
        'shipping_email.required' => 'Email is required.',
        'shipping_mobile.required' => 'Mobile No is required.',
        'shipping_mobile.digits'=> 'Mobile no should contains 10 digits.',
        'shipping_address_line_1.required' => 'Address is required.',
        'shipping_country.required' => 'Country is required.',
        'shipping_city.required' => 'City is required.',
        'shipping_state.required' => 'State is required.',
        'shipping_postcode.required' => 'Postcode is required.',
        'terms.required' => 'Please accept terms & condtions to order.',
    ];
    public function mount(){
        
    }
    
    public function render()
    {
        $cartItems = array();
        if(Auth::check())
        {
            $user_id=Auth::user()->id; 
            $cartItems = CartItem::where('user_id',$user_id)->get(); 

            $this->total_quantity = 0;
            $this->cartTotal = 0;
            foreach($cartItems as $itemInfo)
            {
                $this->total_quantity = $this->total_quantity + $itemInfo->quantity;

                $this->cartTotal = $this->cartTotal + ($itemInfo->quantity * $itemInfo->rate);
            }

            $this->total_tax =  ($this->cartTotal/100)*$this->taxPer;

            $this->cartGrandTotal = $this->cartTotal + $this->deliveryCharge +  $this->total_tax;
            //$this->total_item = count($cartItems);
        }else
        { 
            $this->total_item=0;
        }
        return view('livewire.frontend.checkout',compact('cartItems'));
    }
    public function placeOrder()
    {

        $inputs = $this->validate(); 


        $billing_address['first_name'] = $this->billing_first_name;
        $billing_address['last_name'] = $this->billing_last_name;
        $billing_address['email'] = $this->billing_email;
        $billing_address['mobile'] = $this->billing_mobile;
        $billing_address['address_line_1'] = $this->billing_address_line_1;
        $billing_address['address_line_2'] = $this->billing_address_line_2;
        $billing_address['country'] = $this->billing_country;
        $billing_address['city'] = $this->billing_city;
        $billing_address['state'] = $this->billing_state;
        $billing_address['postcode'] = $this->billing_postcode;

        $shipping_address['first_name'] = $this->shipping_first_name;
        $shipping_address['last_name'] = $this->shipping_last_name;
        $shipping_address['email'] = $this->shipping_email;
        $shipping_address['mobile'] = $this->shipping_mobile;
        $shipping_address['address_line_1'] = $this->shipping_address_line_1;
        $shipping_address['address_line_2'] = $this->shipping_address_line_2;
        $shipping_address['country'] = $this->shipping_country;
        $shipping_address['city'] = $this->shipping_city;
        $shipping_address['state'] = $this->shipping_state;
        $shipping_address['postcode'] = $this->shipping_postcode;


        $billing_address = $shipping_address;

        $orderData = array();
         
        $orderData['user_id'] = Auth::user()->id; 
         
        $orderData['order_id'] = '';
        $orderData['total_qty'] = $this->total_quantity;
        $orderData['billing_address'] = json_encode($billing_address);
        $orderData['shipping_address'] = json_encode($shipping_address);
        $orderData['remark'] = NUll;
        $orderData['cancel_remark'] = NUll;
        $orderData['tracking_id'] = 0;
        $orderData['subtotal'] = $this->cartTotal;
        $orderData['shipping'] = $this->deliveryCharge;
        $orderData['discount'] = $this->cartTotal;
        $orderData['tax'] = $this->cartTotal;
        
        $orderData['total'] = $this->cartGrandTotal;
        $orderData['discount'] = $this->discount;
        $orderData['payment_method'] = 'Online';
        $orderData['paid_status'] = 'Not Paid';
        $orderData['status'] = 'Pending';
        
        $orderInfo = Order::create($orderData);
        $cartItems=CartItem::where('user_id',Auth::user()->id)->get();

        foreach($cartItems as $itemInfo)
        {
            $dbObj = new OrderItem; 
            $dbObj->order_id = $orderInfo->id;      
            $dbObj->product_id = $itemInfo->product_id;
            $dbObj->product_name = $itemInfo->product_name; 
            $dbObj->quantity = $itemInfo->quantity;
            $dbObj->rate = $itemInfo->rate;
            $dbObj->total = $itemInfo->total; 
            $dbObj->save();
        }
        CartItem::where('user_id',Auth::user()->id)->delete();

        $time = time();
        $totalPayment = $this->cartGrandTotal * 100; 
        $name = $this->shipping_first_name.' '.$this->shipping_last_name;
        $email = $this->shipping_email;
        $mobile_number = $this->shipping_email;

        $api = new Api(Config::get('global.razor_key'), Config::get('global.razor_secret'));
        $RazorpayResponse = $api->order->create(array('receipt' => rand(1000,9999), 'amount' => $totalPayment, 'currency' => 'INR', 'notes'=> array('name'=> $name,'email'=> $email,'mobile_number'=> $mobile_number)));

        if(isset($RazorpayResponse->id))
        {
            $order_id = $RazorpayResponse->id;
            Order::where('id',$orderInfo->id)->update(['order_id' => $order_id]);

            $this->dispatchBrowserEvent('orderPayment', [
                    'name' => $name,  
                    'email' => $email, 
                    'mobile_no' => $mobile_number, 
                    'order_id' => $order_id, 
                    'totalPayment' => $totalPayment, 
                ]);
        }
    }
      

   
}