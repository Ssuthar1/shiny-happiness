<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Account;
use App\Models\Category;
use App\Models\MartApplication;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\UserAddress;
use App\Models\SiteSetting;
use App\Models\State;
use App\Models\District;
use Exception, Validator,DB;
use App\Traits\VerifyTokenStatus;
use Livewire\WithPagination;

class DashboardNController extends Controller
{
    use VerifyTokenStatus;

    use WithPagination; 
    protected $paginationTheme = 'bootstrap';

    public function __construct()
    {
        $this->apiArray = array();
        $this->apiArray['error'] = true;
        $this->apiArray['message'] = '';
        $this->apiArray['errorCode'] = 1;

        /*Check Header  
        $headers = getallheaders();
        if (!$this->verifyTokens($headers['Authkey'],null)){
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 200);
        }
        /*End*/
    }

    public function getAddress(Request $request)
    {
         try {
            
            $this->apiArray['state'] = 'getAddress'; 
             
            $user_data = User::find(\Auth::guard('api')->id()); 

            $addressInfo = UserAddress::where('user_id',$user_data->id)->first();
            
            if($addressInfo)
            {
                    $data = array(
                        'id'                =>  $addressInfo->id,
                        'user_id'           =>  $user_data->user_id,
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
                        'postcode'          =>  $addressInfo->postcode,  
                            );
                    $this->apiArray['data'] = $data;
                    $this->apiArray['message'] = 'Success';
                    $this->apiArray['errorCode'] = 0;
                    $this->apiArray['error'] = false;
            }else
            {
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
            return response()->json($this->apiArray, 200);
        }
    }
    public function createUpdateAddress(Request $request)
    {
         try { 
                $this->apiArray['state'] = 'createUpdateAddress';
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

            // $user_data = $request->user();
             $user_data = User::find(\Auth::guard('api')->id()); 

            $addressInfo = UserAddress::where('user_id',$user_data->id)->first();
            
            if($addressInfo)
            {
                UserAddress::where('user_id',$user_data->id)->update($inputs);
                $data = NULL;
                $this->apiArray['data'] = $data;
                $this->apiArray['message'] = 'Address updated successfully';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = false;
                return response()->json($this->apiArray, 200);
            }else{

                $inputs['user_id'] = $user_data->id;
                $inputs['is_default'] = 1;
                UserAddress::create($inputs);
                $data = NULL;
                $this->apiArray['data'] = $data;
                $this->apiArray['message'] = 'Address created successfully';
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

    // public function getDisplayUsers(Request $request)
    // {
        
    // }
    public function getStatement()
    {
        try {
            
            $this->apiArray['state'] = 'getStatement'; 
             
            $user_data = User::find(\Auth::guard('api')->id());
            
            $statement = Account::select('wallet','remarks', 'opening', 'type', 'amount', 'closing', 'created_at')->whereIN('ttype',['12','13'])->where('user_id',$user_data->user_id)->orderby('id','desc')->paginate();

            $data = array();
            $data['current_page'] = $statement->currentPage();
            $data['per_page'] = $statement->perPage();
            $data['total'] = $statement->total();
            $data['getstatement'] = $statement; 


            $this->apiArray['data'] = $data;
            $this->apiArray['message'] = 'Success';
            $this->apiArray['errorCode'] = 0;
            $this->apiArray['error'] = false;
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

    public function getDashboard(Request $request)
    {        
        try {
            $inputs = $request->all();

            $this->apiArray['state'] = 'getDashboard';
            $home_data = [];
            
            $cat_data = Category::select('id','name','slug','image')->where('status',1)->limit(3)->get();

            foreach ($cat_data as $key => $value) {
            	$cat_data[$key]->image = asset($value->image);
            }
            $home_data['category'] = $cat_data;
            
            $cat_data = Category::select('id','name','slug','image')->where('status',1)->limit(6)->get();

            $cat_wise_product = [];
            foreach ($cat_data as $key => $value) {
            	if(count($value->getProducts)){
                    $products = $value->getProducts;
                    foreach ($products as $key1 => $value1) {
                        $products[$key1] = $this->getProductData($value1);
                    }
            		$cat_wise_product[] = array('cat_id'=>$value->id,'cat_name'=>$value->name,'products'=>$products);
            	}
            }
            $home_data['cat_wise_product'] = $cat_wise_product;

            $product_data = Product::where('status',1)->where('is_popular',1)->limit(3)->orderBy('id','desc')->get();
            foreach ($product_data as $key => $value) {
            	$product_data[$key] = $this->getProductData($value);
            }
            $home_data['popular_products'] = $product_data;

            $SiteSetting = SiteSetting::where('slug','mobile_sliders')->first();

            $sliders = [];
            foreach(json_decode($SiteSetting->value) as $key => $value){
            	$sliders[] = asset($value);
            }
            $home_data['sliders'] = $sliders;

            $this->apiArray['data'] = $home_data;
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

    public function productByCategory(Request $request)
    {        
        try {
            $inputs = $request->all();

            $this->apiArray['state'] = 'productByCategory';
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'category_id'          => 'required',
            ]);
            
            if($validator->fails()){
                $this->apiArray['message'] = $validator->messages()->first();
                $this->apiArray['errorCode'] = 3;
                $this->apiArray['error'] = true;
                return response()->json($this->apiArray, 200);
            }

            $product_data = Product::where('status',1)->where('cat_id',$request->category_id)->orderBy('id','desc')->paginate(15);
            foreach ($product_data as $key => $value) {
                $product_data[$key] = $this->getProductData($value);
            }

            $this->apiArray['data'] = $product_data;
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

    public function getStates(Request $request)
    {        
        try {
            $inputs = $request->all();

            $this->apiArray['state'] = 'getStates';

            $data = State::select('id','name')->where('status',1)->get();

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

    public function getCities(Request $request)
    {        
        try {
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'state_id'          => 'required',
            ]);
            
            if($validator->fails()){
                $this->apiArray['message'] = $validator->messages()->first();
                $this->apiArray['errorCode'] = 3;
                $this->apiArray['error'] = true;
                return response()->json($this->apiArray, 200);
            }

            $this->apiArray['state'] = 'getCities';

            $data = District::select('id','name')->where('state_id',$request->state_id)->where('status',1)->get();

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

    public function getDisplayUsers()
    {

       try {
            
            $this->apiArray['state'] = 'getDisplay'; 
             
            // $user_data = User::find(\Auth::guard('api')->id());
            
            $DisplayUserInfo = MartApplication::select('user_id','user_name','address','city','state','postcode','contact_no')->where('type','display')->where('is_approve',1)->paginate(15);
            
             
            // $DisplayUserList= array();
            // foreach($DisplayUserInfo as $key => $DiaplayUserData)
            // {
            //     $DisplayUserList[$key]['user_id'] = $DiaplayUserData->user_id;
            //     $DisplayUserList[$key]['user_name'] = $DiaplayUserData->user_name;
            //     $DisplayUserList[$key]['address'] = $DiaplayUserData->address;
            //     $DisplayUserList[$key]['city'] = $DiaplayUserData->city;
            //     $DisplayUserList[$key]['state'] = $DiaplayUserData->state;
            //     $DisplayUserList[$key]['postcode'] = $DiaplayUserData->postcode; 
            //     $DisplayUserList[$key]['contact_no'] = $DiaplayUserData->contact_no; 
            //     $DisplayUserList[$key]['postcode'] = $DiaplayUserData->postcode; 
            // }
            $data = array();
                $data['current_page'] = $DisplayUserInfo->currentPage();
                $data['per_page'] = $DisplayUserInfo->perPage();
                $data['total'] = $DisplayUserInfo->total();
                $data['displayusers'] = $DisplayUserInfo; 


            $this->apiArray['data'] = $data;
            $this->apiArray['message'] = 'Success';
            $this->apiArray['errorCode'] = 0;
            $this->apiArray['error'] = false;
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
    public function getUserWallets(){

        try {
            
            $this->apiArray['state'] = 'getUserWallets'; 
             
            $user_data = User::find(\Auth::guard('api')->id());
            
            $data = array();
            $data['shopping_voucher_amount'] = $user_data->wallet5;
            $data['shopping_wallet_amount'] = $user_data->wallet4;


            $this->apiArray['data'] = $data;
            $this->apiArray['message'] = 'Success';
            $this->apiArray['errorCode'] = 0;
            $this->apiArray['error'] = false;
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

    public function getWishList(){

        try {
            
            $this->apiArray['state'] = 'getWishList'; 
             
            $user_data = User::find(\Auth::guard('api')->id());

            $wishlistItems=Wishlist::where('user_id',$user_data->id)->pluck('product_id')->toArray();

            $products = Product::whereIn('id',$wishlistItems)->where('status',1)->get();
            
            

            $wishlistproducts = array();

            foreach($products as $key => $wishlistData)
            {
            	$wishlistproducts[$key]['user_id'] = $wishlistData->id;
            	// $wishList[$key]['images'] = $wishlistData->name;
            	$wishlistproducts[$key]['slug'] = $wishlistData->slug;
            	$wishlistproducts[$key]['name'] = $wishlistData->sale_price;
            	$wishlistproducts[$key]['sale_price'] = $wishlistData->price;
            	$wishlistproducts[$key]['image'] = route('viewMacroImage').'?url='.$wishlistData->images;
            }


            $data = array(
            		
                    'wishList'        => $wishlistproducts,
                     
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

    public function addRemoveWishList(Request $request){

        try {
            
            $this->apiArray['state'] = 'getWishList'; 
             
            $user_data = User::find(\Auth::guard('api')->id());
            $product_id = $request->input('product_id');

            $wishlistItem = Wishlist::where('user_id',$user_data->id)->where('product_id',$product_id)->first();


            if (!$wishlistItem) {
                // add to wishlist
                $wishlistItem = new Wishlist;
                $wishlistItem->user_id = $user_data->id;
                $wishlistItem->product_id = $product_id;
                $wishlistItem->save();
    
                $this->apiArray['message'] = 'Added to wishlist';
            } else {
                // remove from wishlist
                $wishlistItem->delete();
                $this->apiArray['message'] = 'Removed from wishlist';
            }

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



    
}
