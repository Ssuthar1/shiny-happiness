<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MartApplication;
use App\Models\OrderDetail;
use App\Models\ProductInventory;
use App\Models\UserWishlist;
use Exception, Validator,DB;
use App\Traits\VerifyTokenStatus;

class OrderController extends Controller
{
    use VerifyTokenStatus;

    public function __construct()
    {
        $this->apiArray = array();
        $this->apiArray['error'] = true;
        $this->apiArray['message'] = '';
        $this->apiArray['errorCode'] = 1;
        $headers = getallheaders();
         /* Check header  
                  if (!isset($headers['apiauthkey']) ||  $headers['apiauthkey']!=env('API_AUTH_KEY')){
                    $this->apiArray['errorCode'] = 2;
                    $this->apiArray['message'] = 'Unauthorized access';
                    $this->apiArray['error'] = true;
                    $this->apiArray['data'] = null;
                    return response()->json($this->apiArray, 200);
                }
        /*End*/
    }
 
 
    public function createOrder(Request $request)
    {        
        try {
            $this->apiArray['state'] = 'createOrder';
            $inputs = $request->all();

            if(isset($inputs['order_point']) && $inputs['order_point']=='mart') 
            {
            	$validator = Validator::make($inputs, [
                'order_point'    => 'required',	/// 'mart' or 'display_user'
				'billing_first_name'        => 'required',
				//  'billing_last_name'        	=> 'required',
				'billing_email'        		=> 'required|email',
				'billing_mobile'        	=> 'required',
				'billing_address_line_1'    => 'required',
				// 'billing_address_line_2'    => 'required',
				'billing_country'        	=> 'required',
				'billing_city'        		=> 'required',
				'billing_state'        		=> 'required',
				'billing_postcode'        	=> 'required',

				'shipping_first_name'       => 'required',
				//  'shipping_last_name'        => 'required',
				'shipping_email'        	=> 'required',
				'shipping_mobile'        	=> 'required',
				'shipping_address_line_1'   => 'required',
				//  'shpping_address_line_2'    => 'required',
				'shipping_country'       	=> 'required',
				'shipping_city'       		=> 'required',
				'shipping_state'       		=> 'required',
				'shipping_postcode'       	=> 'required',
			            ]);
            	$inputs['display_user'] = '';

            }else
            {
            	$validator = Validator::make($inputs, [
	                'order_point'    => 'required'	/// 'mart' or 'display_user'
	            ]);

	            if(isset($inputs['order_point']) && $inputs['order_point']=='display_user') 
	            {
	            	$validator = Validator::make($inputs, [
	                'order_point'    => 'required',	/// 'mart' or 'display_user'
	                'display_user'	=> 'required'
	            ]); 

	            }
            } 
            
            if($validator->fails()){
                $this->apiArray['message'] = 'Please send required fields';
                $this->apiArray['errorCode'] = 3;
                $this->apiArray['error'] = true;
                return response()->json($this->apiArray, 200);
            } 
            $user_data = User::find(\Auth::guard('api')->id()); 
            $inputs['user_id'] = $user_data->id;
             
			if($user_data){

			$cartItems = CartItem::where('user_id',$user_data->id)->get();

			$total = 0;    
            $total_quantity = 0;
            $sub_total = 0;
            foreach($cartItems as $itemInfo)
            { 
               // $total = $total + $itemInfo->total;
                $total_quantity = $total_quantity + $itemInfo->quantity; 
                $sub_total = $sub_total + $itemInfo->total;
            }
            $perItemShipping=80;
            $max_shipping=240;
            $voucher_percent=30;
            $used_voucher_balance=0;
            $used_shopping_wallet_balance=0;
            $shopping_wallet_balance=0;
            $minimum_shop=1350;
            $discount = 0;
            $payment_method='cod';

            $total_voucher_amount = $user_data->wallet5;
            // $total_voucher_amount = 0;
            $shopping_wallet_balance = $user_data->wallet4; 

            $shipping = $perItemShipping * $total_quantity;

            if($shipping>$max_shipping)
            {
                $shipping=$max_shipping;
            } 

            $cart_grand_total = $sub_total + $shipping; 

            $cart_max_voucher_amount = ($sub_total/100)*$voucher_percent; 

	        if($cart_max_voucher_amount<=$total_voucher_amount)
	        {
	            $used_voucher_balance = $cart_max_voucher_amount;
	        }else
	        {
	            $used_voucher_balance = $total_voucher_amount;
	        }
        
        	$used_shopping_wallet_balance = $cart_grand_total - $used_voucher_balance;

        	$bulkUsersList  =  MartApplication::select('user_id')->where('type','display')->where('is_approve',1)->get();
         	$bulkUsers = array();
	        foreach($bulkUsersList as $bulkUser)
	        {
	            $bulkUsers[] = $bulkUser->user_id;
	        }

	        	if($this->checkUserQuantityCapping($user_data->id))
		        {
		        	
		        }

	        if($inputs['order_point']=='display_user' && !in_array($inputs['display_user'],$bulkUsers)) 
	            {
            		 $this->apiArray['message'] = 'Added Partner ID is not authorized to sell products.';
		            $this->apiArray['errorCode'] = 2;
		            $this->apiArray['error'] = true;
		            $this->apiArray['data'] = null;
		            return response()->json($this->apiArray, 200);
	            }

	            if($sub_total<$minimum_shop)
	            {
            	 	$this->apiArray['message'] = "Cart total amount should be : ".$minimum_shop;
		            $this->apiArray['errorCode'] = 2;
		            $this->apiArray['error'] = true;
		            $this->apiArray['data'] = null;
		            return response()->json($this->apiArray, 200);
	            }
	            if($total_quantity==0)
		        {
		        	$this->apiArray['message'] = "Please add products in your cart. ";
		            $this->apiArray['errorCode'] = 2;
		            $this->apiArray['error'] = true;
		            $this->apiArray['data'] = null;
		            return response()->json($this->apiArray, 200);  
		        }

		        if($used_shopping_wallet_balance>$shopping_wallet_balance)
	            {
	                $this->apiArray['message'] = "You don't have sufficient balance in your wallet.";
		            $this->apiArray['errorCode'] = 2;
		            $this->apiArray['error'] = true;
		            $this->apiArray['data'] = null;
		            return response()->json($this->apiArray, 200);
	            }

	            //// Update Wallet Balance & Account Statements
            if($used_shopping_wallet_balance>0)
            {
                $acdata  = array();
                $acdata['date']=date('Y-m-d H:i:s');
                $acdata['user_id']=$user_data->user_id;
                $acdata['opening']=$user_data->wallet4;
                $acdata['amount']=$used_shopping_wallet_balance;
                $acdata['closing']=$acdata['opening']-$acdata['amount'];
                $acdata['wallet']=4;
                $acdata['type']=2;
                $acdata['ttype']=12;
                $acdata['remarks']='New Order ';
                $acdata['status']=1;
                $acdata['remember']='Order';
                $acdata['created_at']=date('Y-m-d H:i:s');
                $acdata['updated_at']=date('Y-m-d H:i:s'); 
                $sh_wallet_account_id=DB::table('accounts')->insertGetId($acdata); 
            }
            if($used_voucher_balance>0)
            {
                $acdata  = array();
                $acdata['date']=date('Y-m-d H:i:s');
                $acdata['user_id']=$user_data->user_id;
                $acdata['opening']=$user_data->wallet5;
                $acdata['amount']=$used_voucher_balance;
                $acdata['closing']=$acdata['opening']-$acdata['amount'];
                $acdata['wallet']=5;
                $acdata['type']=2;
                $acdata['ttype']=12;
                $acdata['remarks']='New Order ';
                $acdata['status']=1;
                $acdata['remember']='Order';
                $acdata['created_at']=date('Y-m-d H:i:s');
                $acdata['updated_at']=date('Y-m-d H:i:s'); 
                $voucher_account_id=DB::table('accounts')->insertGetId($acdata);
            }

            $accountInfo = array();
            $accountInfo['wallet4']=$user_data->wallet4 - $used_shopping_wallet_balance;
            $accountInfo['wallet5']=$user_data->wallet5 - $used_voucher_balance;
       		User::where('id',$user_data->id)->update($accountInfo);

       		/// Save order code start here
       		$billing_address = array();
       		$shipping_address = array();
       		if($inputs['order_point']=='mart')
       		{
       			$billing_address['first_name'] = $inputs['billing_first_name'];
		    	$billing_address['last_name'] = $inputs['billing_last_name'];
		    	$billing_address['email'] = $inputs['billing_email'];
		    	$billing_address['mobile'] = $inputs['billing_mobile'];
		    	$billing_address['address_line_1'] = $inputs['billing_address_line_1'];
		    	$billing_address['address_line_2'] = $inputs['billing_address_line_2'];
		    	$billing_address['country'] = $inputs['billing_country'];
		    	$billing_address['city'] = $inputs['billing_city'];
		    	$billing_address['state'] = $inputs['billing_state'];
		    	$billing_address['postcode'] = $inputs['billing_postcode'];

		    	$shipping_address['first_name'] = $inputs['shipping_first_name'];
		    	$shipping_address['last_name'] = $inputs['shipping_last_name'];
		    	$shipping_address['email'] = $inputs['shipping_email'];
		    	$shipping_address['mobile'] = $inputs['shipping_mobile'];
		    	$shipping_address['address_line_1'] = $inputs['shipping_address_line_1'];
		    	$shipping_address['address_line_2'] = $inputs['shipping_address_line_2'];
		    	$shipping_address['country'] = $inputs['shipping_country'];
		    	$shipping_address['city'] = $inputs['shipping_city'];
		    	$shipping_address['state'] = $inputs['shipping_state'];
		    	$shipping_address['postcode'] = $inputs['shipping_postcode'];
       		}
       		

	    	$orderData = array();
	    	if(!empty($this->user_id))
	    	{
	    		$orderData['user_id'] = $user_data->id;
	    	}
	        $orderData['u_user_id'] =$user_data->user_id;
	        $orderData['order_point'] = $inputs['order_point'];
	        $orderData['display_user'] = $inputs['display_user'];
	    	$orderData['order_number'] = 'MBO_'.time();
	    	$orderData['total_qty'] = $total_quantity;
	    	$orderData['billing_address'] = json_encode($billing_address);
	    	$orderData['shipping_address'] = json_encode($shipping_address);
	    	$orderData['subtotal'] = $sub_total;
	    	$orderData['shipping'] = $shipping;
	        $orderData['voucher_amount'] = $used_voucher_balance;
	        $orderData['wallet_amount'] = $used_shopping_wallet_balance; 
	    	$orderData['total_amount'] = $cart_grand_total;
	    	$orderData['discount'] = $discount;
	    	$orderData['payment_method'] = $payment_method;
	    	$orderData['paid_status'] = 1;
	     
    	 	$orderInfo = Order::create($orderData);

    	 	if($orderInfo->id)
                {

                    /// Update Account Info Remarks
                    if(isset($sh_wallet_account_id) && !empty($sh_wallet_account_id))
                    {
                        DB::table('accounts')->where('id',$sh_wallet_account_id)->update(['remarks'=>'Order ID# : '.$orderInfo->id.' Order Number# : '.$orderInfo->order_number]);
                    }
                    if(isset($voucher_account_id)  && !empty($voucher_account_id))
                    {
                        DB::table('accounts')->where('id',$voucher_account_id)->update(['remarks'=>'Order ID# : '.$orderInfo->id.' Order Number# : '.$orderInfo->order_number]);
                    }
                    /// End of Update Account Info Remarks

                   foreach($cartItems as $itemInfo)
                    { 
                    	if(!empty($itemInfo->inventory_id))
                    	{
                    		$inventoryInfo = ProductInventory::find($itemInfo->inventory_id);

                            $balance_inventory = $inventoryInfo->current_stock-$itemInfo->quantity;
                            $out_of_stock = 0;
                            if($balance_inventory==0)
                            {
                                $out_of_stock = 1;
                            }
                            $inventoryInfo->update(['current_stock'=>$balance_inventory,'out_of_stock'=>$out_of_stock]); 
                    	}else
                    	{
                    		$inventoryInfo = Product::find($itemInfo->product_id);

                            $balance_inventory = $inventoryInfo->current_stock-$itemInfo->quantity;
                            $in_stock = 1;
                            if($balance_inventory==0)
                            {
                                $in_stock = 0;
                            }
                            $inventoryInfo->update(['current_stock'=>$balance_inventory,'in_stock'=>$in_stock]);
                    	}
                        /// Update Product item inventory 
                        
                        /// End of update product item inventory

                        $dbObj = new OrderItem; 
                        $dbObj->order_id = $orderInfo->id;      
                        $dbObj->product_id = $itemInfo->product_id;
                        $dbObj->inventory_id = $itemInfo->inventory_id; 
                        if(isset($itemInfo->sizeInfo->title))
                        {
                        	 $dbObj->size = $itemInfo->sizeInfo->title;
                        }
                     	if(isset($itemInfo->colorInfo->title))
                        {
                        	$dbObj->color = $itemInfo->colorInfo->title;
                        } 

                        $dbObj->quantity = $itemInfo->quantity;
                        $dbObj->rate = $itemInfo->rate;
                        $dbObj->total = $itemInfo->total; 
                        $dbObj->save();
                    }
            	}
             $cartItems=CartItem::where('user_id',$user_data->id)->delete();//
 

                $this->apiArray['data'] = NULL;
                $this->apiArray['message'] = 'Order created successfully.';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = false;
            }
            
            return response()->json($this->apiArray, 200);
        } catch (\Exception $e) {
            $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 200);
        }
    }
 	protected function checkUserQuantityCapping($user_id)
    {
        $error = false;
        if(!empty($user_id))
            {
                $cartItems=CartItem::where('user_id',$user_id)->get(); 
                $total_items = $cartItems->count();
                $this->total_items = $total_items; 
            }

             foreach($cartItems as $itemInfo)
            {  
                    $inventoryInfo = Product::find($itemInfo->product_id); 
                    if(isset($inventoryInfo->user_capping) && $inventoryInfo->user_capping>0)
                    {
                        
                        if($itemInfo->quantity>$inventoryInfo->user_capping)
                           {
                             $error = true;  
                             $this->cappingError[$itemInfo->id]=true;
                           }    
                    } 
                    
                
            }
        return $error;
    }


    public function getOrders(Request $request)
    {        
        try {
            $this->apiArray['state'] = 'getOrders';
            $user_data = $request->user();

            $order_data = Order::where('user_id',$user_data->id)->orderBy('id','desc')->get();

            $this->apiArray['data'] = $order_data;
            $this->apiArray['message'] = 'Order get successfully.';
            $this->apiArray['errorCode'] = 0;
            $this->apiArray['error'] = false;            
            return response()->json($this->apiArray, 200);
        } catch (\Exception $e) {
            $this->apiArray['message'] = 'Something is wrong, please try after some time';
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 200);
        }
    }

    public function getOrderDetail(Request $request,$id)
    {
        try {
            $this->apiArray['state'] = 'getOrderDetail';
            $user_data = $request->user();

            $order_data = Order::find($id);

            if(!empty($order_data)){
                $order_details = $order_data->getOrderDetail;
                $products = [];
                if(count($order_details)){
                    foreach ($order_details as $key => $value) {
                        if(!empty($value->getProductDetail)){
                            $product_name = $value->getProductDetail->name;
                            $products[] = array(
                                        'product_name'  => $product_name,
                                        'qty'  => $value->qty,
                                        'price'  => $value->price,
                                    );
                        }
                    }
                }
                unset($order_data->getOrderDetail);
                $order_data['products'] = $products;
                $this->apiArray['data'] = $order_data;
                $this->apiArray['message'] = 'Order data get successfully.';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = true;
            }else{
                $this->apiArray['data'] = NULL;
                $this->apiArray['message'] = 'Order not found.';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = true;    
            }
                        
            return response()->json($this->apiArray, 200);
        } catch (\Exception $e) {
            $this->apiArray['message'] = 'Something is wrong, please try after some time';
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 200);
        }
    }

    public function getWishlists(Request $request)
    {        
        try {
            $this->apiArray['state'] = 'getWishlists';
            $user_data = $request->user();
            $data = UserWishlist::select('id','user_id','product_id')->where('user_id',$user_data->id)->get();
            
            foreach ($data as $key => $value) {
                if(!empty($value->getProductDetail)){
                    $data[$key] = $this->getProductData($value->getProductDetail);
                }else{
                    UserWishlist::where('id',$value->id)->delete();
                }
            }
            $this->apiArray['data'] = $data;
            $this->apiArray['message'] = 'Success';
            $this->apiArray['errorCode'] = 0;
            $this->apiArray['error'] = false;
            return response()->json($this->apiArray, 200);
        } catch (\Exception $e) {
            $this->apiArray['message'] = 'Something is wrong, please try after some time';
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 200);
        }
    }

    public function updateWishlist(Request $request)
    {        
        try {
            $this->apiArray['state'] = 'updateWishlist';
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'product_id'    => 'required'
            ]);
            
            if($validator->fails()){
                $this->apiArray['message'] = $validator->messages()->first();
                $this->apiArray['errorCode'] = 3;
                $this->apiArray['error'] = true;
                return response()->json($this->apiArray, 200);
            }

            $inputs['user_id'] = $request->user()->id;
            $user_data = $request->user();

            $check_product = Product::where('id',$inputs['product_id'])->where('status',1)->first();
            if(!empty($check_product)){
                    $check_wishlist = UserWishlist::where('user_id',$user_data->id)->where('product_id',$inputs['product_id'])->first();
                    if(!empty($check_wishlist)){
                        $check_wishlist->delete();
                        $this->apiArray['message'] = 'Product removed from wishlist.';
                    }else{
                        UserWishlist::create([
                            'user_id'=>$user_data->id,
                            'product_id'=>$inputs['product_id']
                        ]);
                        $this->apiArray['message'] = 'Product added to wishlist.';
                    }
                    $this->apiArray['data'] = NULL;
                    $this->apiArray['errorCode'] = 0;
                    $this->apiArray['error'] = false;
            }else{
                $this->apiArray['data'] = NULL;
                $this->apiArray['message'] = 'Product is not available.';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = true;
            }
            return response()->json($this->apiArray, 200);
        } catch (\Exception $e) {
            $this->apiArray['message'] = 'Something is wrong, please try after some time';
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 200);
        }
    }
}
