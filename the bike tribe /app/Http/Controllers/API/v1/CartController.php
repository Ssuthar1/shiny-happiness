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
use App\Models\OrderDetail;
use App\Models\UserWishlist;
use Exception, Validator,DB;
use App\Traits\VerifyTokenStatus;

class CartController extends Controller
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

    public function updateCart(Request $request)
    {        
        try {

            $this->apiArray['state'] = 'updateCart';
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'product_id' 	=> 'required',
                'qty' 		    => 'required'
    	    ]);
			
    		if($validator->fails()){
    			$this->apiArray['message'] = 'Please send required fields';
                $this->apiArray['errorCode'] = 3;
    			$this->apiArray['error'] = true;
    			return response()->json($this->apiArray, 200);
    		} 
            $user_data = User::find(\Auth::guard('api')->id()); 

            $inputs['user_id'] = $user_data->id;
            
            $user_id = $user_data->id;
            $selected_quantity = $inputs['qty'];

            $productInfo = Product::where('id',$inputs['product_id'])->first();
             if(isset($productInfo->getInventory) && count($productInfo->getInventory)>0)
            {
                if(!isset($inputs['color_id']) || empty($inputs['color_id'])  )
                {
                    $this->apiArray['message'] = 'Please select product color';
                    $this->apiArray['errorCode'] = 4;
                    $this->apiArray['error'] = true;
                    return response()->json($this->apiArray, 200);
                }
                if(!isset($inputs['size_id']) || empty($inputs['size_id'])  )
                {
                    $this->apiArray['message'] = 'Please select product size';
                    $this->apiArray['errorCode'] = 5;
                    $this->apiArray['error'] = true;
                    return response()->json($this->apiArray, 200);
                } 

                $inventory = ProductInventory::where('product_id',$inputs['product_id'])->where('color_id',$inputs['color_id'])->where('size_id',$inputs['size_id'])->first();
                if($inventory !=null)
                {
                    if($inventory->out_of_stock==1 || $inventory->current_stock==0)
                    { 
                        $this->apiArray['message'] = 'Current product is out of stock';
                        $this->apiArray['errorCode'] = 6;
                        $this->apiArray['error'] = true;
                        return response()->json($this->apiArray, 200);
                    }
                } 

            }else
            {
                if($productInfo->in_stock==0 || $productInfo->current_stock<=0 )
                {
                    $this->apiArray['message'] = 'Current product is out of stock';
                    $this->apiArray['errorCode'] = 6;
                    $this->apiArray['error'] = true;
                    return response()->json($this->apiArray, 200);
                }
            }

            $selected_color = '';
            $selected_size = ''; 
           
            if(isset($inputs['color_id']) && !empty($inputs['color_id'])  )
                {
                    $selected_color = $inputs['color_id'];
                }

            if(isset($inputs['size_id']) && !empty($inputs['size_id'])  )
                {
                    $selected_size = $inputs['size_id'];
                }
            $product_exist = CartItem::where('user_id',$user_id)->where('product_id',$inputs['product_id'])->where('size',$selected_size)->where('color',$selected_color)->first();

             if($product_exist) /// Check exist cart item
            {
                $quantity = $product_exist->quantity+$selected_quantity;
                $total = $product_exist->rate * $quantity; 

                if(isset($inventory) && $inventory!=null)
                {
                     if($inventory->current_stock>$quantity)  
                    {
                        $product_exist->update(['quantity'=>$quantity, 'total'=>$total]);
                    }else
                    {
                        $this->apiArray['message'] = 'Current product is out of stock';
                        $this->apiArray['errorCode'] = 6;
                        $this->apiArray['error'] = true;
                        return response()->json($this->apiArray, 200);
                    }
                }else
                {
                    if($productInfo->in_stock==1)
                    {      
                        $product_exist->update(['quantity'=>$quantity, 'total'=>$total]);  
                    }else
                    {
                        $this->apiArray['message'] = 'Current product is out of stock';
                        $this->apiArray['errorCode'] = 6;
                        $this->apiArray['error'] = true;
                        return response()->json($this->apiArray, 200);
                    } 
                } 

            }else // Add new cart
            { 

                $product_price = $productInfo->price;
                if(!empty($productInfo->sale_price) && $productInfo->sale_price>0 )
                {
                    $product_price = $productInfo->sale_price;
                }
                if(!empty($inventory->price) && $inventory->price>0 )
                {
                    $product_price =$inventory->price;
                }
                if(isset($inventory->id))
                {
                    $inventory_id = $inventory->id;
                }else
                {
                    $inventory_id = null;
                }

                $dbObj = new CartItem;  
                $dbObj->user_id = $user_id;  
                $dbObj->product_id = $inputs['product_id'];
                $dbObj->inventory_id = $inventory_id; 
                $dbObj->size = $selected_size;
                $dbObj->color = $selected_color;
                $dbObj->quantity = $selected_quantity;
                $dbObj->rate = $product_price;
                $dbObj->total = $product_price * $selected_quantity; 
                $dbObj->save();
            }
 
                $this->apiArray['data'] = NULL;
                $this->apiArray['message'] = 'Product added to cart.';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = false; 
            
            return response()->json($this->apiArray, 200);
        } catch (\Exception $e) {
            $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 200);
        }
    }

    public function removeCart(Request $request)
    {        
        try {
            $this->apiArray['state'] = 'removeCart';
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'id'    => 'required'
            ]);
            
            if($validator->fails()){
                $this->apiArray['message'] = 'Please send required fields';
                $this->apiArray['errorCode'] = 3;
                $this->apiArray['error'] = true;
                return response()->json($this->apiArray, 200);
            } 
            
            $user_data = User::find(\Auth::guard('api')->id()); 
            
            $inputs['user_id'] = $user_data->id;

            CartItem::where('id',$inputs['id'])->where('user_id',$user_data->id)->delete();
            $this->apiArray['data'] = NULL;
            $this->apiArray['message'] = 'Product removed from cart.';
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

    public function getCart(Request $request)
    {        
        try {
            
            $this->apiArray['state'] = 'getCart';
            $user_data = User::find(\Auth::guard('api')->id());   

    		$cartItems = CartItem::where('user_id',$user_data->id)->get();
            $data = [];
            
            $total = 0;    
            $total_quantity = 0;
            foreach($cartItems as $itemInfo)
            { 
                $total = $total + $itemInfo->total;
                $total_quantity = $total_quantity + $itemInfo->quantity; 
            }
            $perItemShipping=80;
            $max_shipping=240;

            $shipping = $perItemShipping * $total_quantity;
            if($shipping>$max_shipping)
            {
                $shipping=$max_shipping;
            }
            $sub_total = 0;
            foreach ($cartItems as $key => $value) {
                if(!empty($value->productInfo)){

                    $productInfo = $value->productInfo;
                    $product_img = '';
                    if(!empty($productInfo->images)){
                         $product_img = route('viewMacroImage').'?url='.$productInfo->images;
                    }
                    $product_name = $productInfo->name;
                    $sub_total = $sub_total + $value->total;
                    $color = NULL;
                    $size = NULL;
                    if(!empty($value->color))
                    {
                        if(isset($value->colorInfo->title))
                        {
                            $color = $value->colorInfo->title; 
                        }
                       
                    }
                    if(!empty($value->size))
                    {
                        if(isset($value->sizeInfo->title))
                        {
                            $size = $value->sizeInfo->title; 
                        }
                    }

                    $data[] = array(
                                'id'            =>$value->id,
                                'product_id'    =>$value->product_id,
                                'quantity'      =>$value->quantity,
                                'rate'          =>$value->rate,
                                'total_price'   => $value->total,
                                'product_img'   =>$product_img,
                                'product_name'  =>$product_name, 
                                'color'         => $color,
                                'size'          => $size,
                                 
                            );
                }else{
                    Cart::where('id',$value->id)->delete();
                }
            }

            $data = array(
                    'cart_data' => $data,
                    'total_qty' => $total_quantity,
                    'sub_total' => round($sub_total,2),
                    'shipping' => round($shipping,2),
                    'total_amount' => round($sub_total+$shipping,2),
                   // 'default_address' => $user_data->getDefaultAddress,
                );
            $this->apiArray['data'] = $data;
            $this->apiArray['message'] = 'Success';
            $this->apiArray['errorCode'] = 0;
            $this->apiArray['error'] = false;
            return response()->json($this->apiArray, 200);
        } catch (\Exception $e) {
            $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 200);
        }
    }



}
