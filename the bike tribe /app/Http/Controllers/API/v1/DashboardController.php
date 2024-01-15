<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Account;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Order;
use App\Models\MartApplication;
use App\Models\UserAddress;
use App\Models\SiteSetting;
use App\Models\State;
use App\Models\District;
use Exception, Validator,DB;
use App\Traits\VerifyTokenStatus;

class DashboardController extends Controller
{
    use VerifyTokenStatus;

    public function __construct()
    {
        $this->apiArray = array();
        $this->apiArray['error'] = true;
        $this->apiArray['message'] = '';
        $this->apiArray['errorCode'] = 1;
    }


    public function createAddress(Request $request)
    {
         try { 
            $this->apiArray['state'] = 'createAddress';
            $headers = getallheaders();
            /*Check header */
                $userinfo = $request->user();
                if (!$this->verifyTokens($headers['Authkey'],$userinfo->id)){
                    $this->apiArray['errorCode'] = 2;
                    $this->apiArray['message'] = 'Unauthorized access';
                    $this->apiArray['error'] = true;
                    $this->apiArray['data'] = null;
                    return response()->json($this->apiArray, 419);
                }
            /*End*/

            $inputs = $request->all();

            $validator = Validator::make($inputs, [ 
                'first_name'        => 'required',
                'last_name'         => 'required',
                'email'             => 'required|email',
                'mobile'            => 'required',
                'address_line_1'    => 'required',
                'address_line_2'    => 'required',
                'country'           => 'required',
                'city'              => 'required',
                'state'             => 'required',
                'postcode'          => 'required', 
            ]);
            
            if($validator->fails()){
                $this->apiArray['message'] = $validator->messages()->first();
                 $this->apiArray['errorCode'] = 3;
                 $this->apiArray['error'] = true;
                 return response()->json($this->apiArray, 200);
             }
             $inputs['user_id'] = $userinfo->id;

            UserAddress::create($inputs);
            $this->apiArray['data'] = NULL;
            $this->apiArray['message'] = 'Address created successfully';
            $this->apiArray['errorCode'] = 0;
            $this->apiArray['error'] = false;
            return response()->json($this->apiArray, 200);

        } catch (\Exception $e) {
            $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 500);
        } 
    }

    public function updateAddress(Request $request, $id)
    {
         try { 
            $this->apiArray['state'] = 'updateAddress';
            $headers = getallheaders();
            /*Check header */
                $userinfo = $request->user();
                if (!$this->verifyTokens($headers['Authkey'],$userinfo->id)){
                    $this->apiArray['errorCode'] = 2;
                    $this->apiArray['message'] = 'Unauthorized access';
                    $this->apiArray['error'] = true;
                    $this->apiArray['data'] = null;
                    return response()->json($this->apiArray, 419);
                }
            /*End*/

            $inputs = $request->all();

            $validator = Validator::make($inputs, [ 
                'first_name'        => 'required',
                'last_name'         => 'required',
                'email'             => 'required|email',
                'mobile'            => 'required',
                'address_line_1'    => 'required',
                'address_line_2'    => 'required',
                'country'           => 'required',
                'city'              => 'required',
                'state'             => 'required',
                'postcode'          => 'required', 
            ]);
            
            if($validator->fails()){
                $this->apiArray['message'] = $validator->messages()->first();
                 $this->apiArray['errorCode'] = 3;
                 $this->apiArray['error'] = true;
                 return response()->json($this->apiArray, 200);
             }

            UserAddress::where('id',$id)->update($inputs);
            $this->apiArray['data'] = NULL;
            $this->apiArray['message'] = 'Address update successfully';
            $this->apiArray['errorCode'] = 0;
            $this->apiArray['error'] = false;
            return response()->json($this->apiArray, 200);

        } catch (\Exception $e) {
            $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 500);
        } 
    }

    public function getAddress(Request $request)
    {
         try {
            
            $this->apiArray['state'] = 'getAddress';
            $headers = getallheaders();
            /*Check header */
                $userinfo = $request->user();
                if (!$this->verifyTokens($headers['Authkey'],$userinfo->id)){
                    $this->apiArray['errorCode'] = 2;
                    $this->apiArray['message'] = 'Unauthorized access';
                    $this->apiArray['error'] = true;
                    $this->apiArray['data'] = null;
                    return response()->json($this->apiArray, 419);
                }
            /*End*/
            $addressGet = UserAddress::where('user_id',$userinfo->id)->get();
            
            if(count($addressGet))
            {
                $data = [];
                foreach ($addressGet as $key => $addressInfo) {
                    $data[] = array(
                        'id'                =>  $addressInfo->id,
                        'user_id'           =>  $userinfo->user_id,
                        'first_name'        =>  $addressInfo->first_name,
                        'last_name'         =>  $addressInfo->last_name,
                        'email'             =>  $addressInfo->email,
                        'mobile'            =>  $addressInfo->mobile,
                        'email'             =>  $addressInfo->email,
                        'address_line_1'    =>  $addressInfo->address_line_1,
                        'address_line_2'    =>  $addressInfo->address_line_2,
                        'country'           =>  $addressInfo->country,
                        'city'              =>  $addressInfo->city,
                        'state'             =>  $addressInfo->state,
                        'is_default'        =>  $addressInfo->is_default,
                        'postcode'          =>  $addressInfo->postcode,  
                    );
                }
                $this->apiArray['data'] = $data;
                $this->apiArray['message'] = 'Success';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = false;
            }else{
                $data = []; 
                $this->apiArray['data'] = $data;
                $this->apiArray['message'] = 'Address not created';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = false;
            } 
            
            return response()->json($this->apiArray, 200);
        } catch (\Exception $e) {
            $this->apiArray['message'] = 'Something is wrong, please try after some time';
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 500);
        }
    }

    public function makeDefaultAddress(Request $request , $id){
        
        try {
            $this->apiArray['state'] = 'makeDefaultAddress';
            $headers = getallheaders();

            /*Check header */
                $userinfo = $request->user();
                if (!$this->verifyTokens($headers['Authkey'],$userinfo->id)){
                    $this->apiArray['errorCode'] = 2;
                    $this->apiArray['message'] = 'Unauthorized access';
                    $this->apiArray['error'] = true;
                    $this->apiArray['data'] = null;
                    return response()->json($this->apiArray, 419);
                }
            /*End*/
            UserAddress::where('user_id',$userinfo->id)->update(['is_default'=>0]);
            $getAddress = UserAddress::where('id',$id)->where('user_id',$userinfo->id)->first();
            if(isset($getAddress) && !empty($getAddress)){
                $getAddress->update(['is_default'=>1]);
                $this->apiArray['data'] = NULL;
                $this->apiArray['message'] = 'Default address set successfully.';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = false;
            }else{
                $this->apiArray['data'] = NULL;
                $this->apiArray['message'] = 'Address not found';
                $this->apiArray['errorCode'] = 200;
                $this->apiArray['error'] = false;
            }

            return response()->json($this->apiArray, 200);
        } catch (\Exception $e) {
            $this->apiArray['message'] = 'Something is wrong, please try after some time';
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 500);
        }
    }

    public function getOrders(Request $request)
    { 
        try {
            $this->apiArray['state'] = 'getOrders'; 
            $headers = getallheaders();

            /*Check header */
            $userinfo = $request->user();
            if (!$this->verifyTokens($headers['Authkey'],$userinfo->id)){
                $this->apiArray['errorCode'] = 2;
                $this->apiArray['message'] = 'Unauthorized access';
                $this->apiArray['error'] = true;
                $this->apiArray['data'] = null;
                return response()->json($this->apiArray, 419);
            }
            /*End*/
            $inputs = $request->all();   

            $orders = Order::where('user_id',$userinfo->id)->paginate(15);
            
            if($orders)
            { 
                $ordersList = array(); 
                foreach($orders as $key => $orderInfo)
                {
                    $ordersList[$key]['id']             = $orderInfo->id;
                    $ordersList[$key]['order_number']   = $orderInfo->order_number;
                    $ordersList[$key]['subtotal']       = $orderInfo->subtotal;
                    $ordersList[$key]['order_date']     = date('d m Y H:s' ,strtotime($orderInfo->created_at));
                    $ordersList[$key]['discount']       = $orderInfo->discount;
                    $ordersList[$key]['status']         = $orderInfo->status; 
                }

                $data = array();
                $data['current_page'] = $orders->currentPage();
                $data['per_page'] = $orders->perPage();
                $data['total'] = $orders->total();
                $data['orders'] = $ordersList; 

                $this->apiArray['data'] = $data;
                $this->apiArray['message'] = 'Success';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = false;
            }else
            {
                $data = []; 
                $this->apiArray['data'] = $data;
                $this->apiArray['message'] = 'No Orders found';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = false;
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
    public function getOrderDetail(Request $request)
    {
        try {
            $this->apiArray['state'] = 'getProductDetails';
            $headers = getallheaders();
            /*Check header */
                $userinfo = $request->user();
                if (!$this->verifyTokens($headers['Authkey'],$userinfo->id)){
                    $this->apiArray['errorCode'] = 2;
                    $this->apiArray['message'] = 'Unauthorized access';
                    $this->apiArray['error'] = true;
                    $this->apiArray['data'] = null;
                    return response()->json($this->apiArray, 419);
                }
            /*End*/
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'id' => 'required'
            ]);
            
            if($validator->fails()){
                $this->apiArray['message'] = $validator->messages()->first();
                $this->apiArray['errorCode'] = 3;
                $this->apiArray['error'] = true;
                return response()->json($this->apiArray, 200);
            }
            $inputs = $request->all();   

            $user_data = Auth::guard('api')->user();  
            
            $order = Order::where('user_id',$user_data->id)->where('id',$inputs['id'])->first();
            $orderInfo = array();
            // dd($order);
            if(!empty($order))
            {
                $orderInfo['id'] = $order->id;
                $orderInfo['user_id'] = $order->user_id;
                $orderInfo['order_number'] = $order->order_number;
                $orderInfo['total_qty'] = $order->total_qty;
                $orderInfo['remark'] = $order->remark;
                $orderInfo['cancel_remark'] = $order->cancel_remark;
                $orderInfo['tracking_id'] = $order->tracking_id;
                $orderInfo['subtotal'] = $order->subtotal;
                $orderInfo['shipping'] = $order->shipping;
                $orderInfo['discount'] = $order->discount;
                $orderInfo['status'] = $order->status;

                $orderItems = array();
                if(count($order->getOrderItems)>0)
                {
                    foreach($order->getOrderItems as $key=> $itemInfo)
                    {
                        $orderItems[$key]['product_id'] = $itemInfo->product_id;

                        if(isset($itemInfo->product_name))
                        {
                            $orderItems[$key]['product_title'] = $itemInfo->product_name;
                        }
                        if(isset($itemInfo->productInfo->images))
                        {
                            $orderItems[$key]['image'] = route('displayImage').'?imagepath='.$itemInfo->productInfo->images;
                        }  
                        $orderItems[$key]['inventory_id'] = $itemInfo->inventory_id;
                        $orderItems[$key]['inventory_name'] = $itemInfo->inventory_name;
                        $orderItems[$key]['quantity'] = $itemInfo->quantity;
                        $orderItems[$key]['rate'] = $itemInfo->rate;
                        $orderItems[$key]['total'] = $itemInfo->total;
                    }
                    $orderInfo['order_items'] = $orderItems;
                }

            }
         //   $orderInfo = $order;
            if(!empty($orderInfo)){ 

                $this->apiArray['data'] = $orderInfo;
                $this->apiArray['message'] = 'Success';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = false;
                return response()->json($this->apiArray, 200);
            }
               else
            {
                $this->apiArray['data'] = NULL;
                $this->apiArray['message'] = 'Order not found';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = false;
                return response()->json($this->apiArray, 200);
            }
        } catch (\Exception $e) {
            $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 200);
        }
    }

    public function getProductDetail($id = ''){
        $productInfo = $productInventory = [];
        if(!empty($id)){
            $productDetail = Product::where('id',$id)->first();
            $productInfo['name'] = $productDetail->name;
            $productInfo['image'] = route('displayImage').'?imagepath='.$itemInfo->productInfo->images;
            $productInfo['sku_id'] = $productDetail->sku_id;
            if(isset($productDetail->getProductInventory) && count($productDetail->getProductInventory)){
                foreach ($productDetail->getProductInventory as $key => $inventoryValue) {
                    $productInventory[$key]['unit_name'] = $inventoryValue->unit_name;
                    $productInventory[$key]['current_stock'] = $inventoryValue->current_stock;
                    $productInventory[$key]['price'] = $inventoryValue->price;
                    $productInventory[$key]['sale_price'] = $inventoryValue->sale_price;
                    $productInventory[$key]['custom_message'] = $inventoryValue->custom_message;
                }
            $productInfo['product_inventory'] = $productInventory;
            }
        }
        return $productInfo;
    }

    public function getWishList(Request $request){
        try {
            
            $this->apiArray['state'] = 'getWishList'; 
            $headers = getallheaders();
            /*Check header */
                $userinfo = $request->user();
                if (!$this->verifyTokens($headers['Authkey'],$userinfo->id)){
                    $this->apiArray['errorCode'] = 2;
                    $this->apiArray['message'] = 'Unauthorized access';
                    $this->apiArray['error'] = true;
                    $this->apiArray['data'] = null;
                    return response()->json($this->apiArray, 419);
                }
            /*End*/

            $wishlistItems=Wishlist::where('user_id',$userinfo->id)->pluck('product_id')->toArray();

            $products = Product::whereIn('id',$wishlistItems)->where('status',1)->get(); 

            $wishlistproducts = array();

            foreach($products as $key => $wishlistData)
            {
                $wishlistproducts[$key]['id']           = $wishlistData->id;
                $wishlistproducts[$key]['slug']         = $wishlistData->slug;
                $wishlistproducts[$key]['name']         = $wishlistData->name;
                $wishlistproducts[$key]['sale_price']   = $wishlistData->sale_price;
                $wishlistproducts[$key]['price']        = $wishlistData->price;
                $wishlistproducts[$key]['image']        = route('displayImage').'?imagepath='.$wishlistData->image;
            } 
            $data = array( 
                'wishList'  => $wishlistproducts, 
            );

            $this->apiArray['message'] = 'Success';
            $this->apiArray['errorCode'] = 0;
            $this->apiArray['error'] = false; 
            $this->apiArray['data'] = $data;  
            return response()->json($this->apiArray, 200); 
            
        }
        catch (\Exception $e){
            $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 200);
        }

    }
    public function addRemoveWishlist(Request $request)
    {
       try {
            $this->apiArray['state'] = 'addRemoveWishlist';
            $headers = getallheaders(); 
              
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'product_id' => 'required'
            ]);
            
            if($validator->fails()){
                $this->apiArray['message'] = $validator->messages()->first();
                $this->apiArray['errorCode'] = 3;
                $this->apiArray['error'] = true;
                return response()->json($this->apiArray, 200);
            }

            $user_data = User::find(\Auth::guard('api')->id()); 

            $wishlist = Wishlist::where('user_id',$user_data->id)->where('product_id',$inputs['product_id'])->first(); 

            if(!empty($wishlist)){

                $wishlist = Wishlist::where('user_id',$user_data->id)->where('product_id',$inputs['product_id'])->delete(); 
                $this->apiArray['data'] = NULL;
                $this->apiArray['message'] = 'Product removed from wishlist successfully';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = false;
                return response()->json($this->apiArray, 200);
            }
            else
            {
                $data = array();
                $data['user_id']=$user_data->id;
                $data['product_id']=$inputs['product_id'];
                Wishlist::create($data);  
                $this->apiArray['data'] = NULL;
                $this->apiArray['message'] = 'Product added to wishlist successfully';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = false;
                return response()->json($this->apiArray, 200);

                
            }
        } catch (\Exception $e) {
            $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 200);
        } 
    }
}
