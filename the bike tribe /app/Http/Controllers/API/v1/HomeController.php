<?php
namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Product;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Order;
use App\Models\Size;
use App\Models\SiteSetting; 
use App\Models\Category;
use App\Models\CategoryProduct;
use Exception, Validator,DB;
use App\Traits\VerifyTokenStatus;

class HomeController extends Controller
{
    use VerifyTokenStatus;

    public function __construct()
    {
        $this->apiArray = array();
        $this->apiArray['error'] = true;
        $this->apiArray['message'] = '';
        $this->apiArray['errorCode'] = 1; 
    }
    public function homeContents(Request $request)
    {
    	 try{

            $this->apiArray['state'] = 'homeContents';
            $headers = getallheaders(); 
            /*Check header  
              if (!isset($headers['apiauthkey']) ||  $headers['apiauthkey']!=env('API_AUTH_KEY')){
                $this->apiArray['errorCode'] = 2;
                $this->apiArray['message'] = 'Unauthorized access';
                $this->apiArray['error'] = true;
                $this->apiArray['data'] = null;
                return response()->json($this->apiArray, 200);
            }
            /*End*/
            $inputs = $request->all();            
            $validator = Validator::make($inputs, [
                //'type' => 'required', 
            ]);
            if($validator->fails()){
                $this->apiArray['message'] = $validator->messages()->first();
                $this->apiArray['errorCode'] = 3;
                $this->apiArray['error'] = true;
                return response()->json($this->apiArray, 200);
            }

            $mainCategoryList = Category::select('id','name')->where('status', 1)
                      ->where(function ($query) {
                          $query->whereNull('parent_id')
                                ->orWhere('parent_id', 0);
                      })
                      ->get();
                $categories = array();
            foreach($mainCategoryList as $key => $catInfo)
            {
                $categories[$key]['id'] = $catInfo->id;
                $categories[$key]['name'] = $catInfo->name;


                if(count($catInfo->children)>0) 
                {
                    $childCategory = array();
                    foreach($catInfo->children as $childKey=> $childCategoryInfo)
                    {
                        $childCategory[$childKey]['id'] = $childCategoryInfo->id;
                        $childCategory[$childKey]['name'] = $childCategoryInfo->name;
                    }
                    $categories[$key]['childCategory'] = $childCategory;
                }else{
                    $categories[$key]['childCategory'] = [];
                }
            }

          	$setting = SiteSetting::where('id',1)->first();
        	$settingInfo = json_decode($setting->value);

        	$bannerType = array();
        	$bannerType[] = 'hometop';
        	$bannerType[] = 'bottom'; 

    	 	$banners= Banner::where('status','1')->whereIn('banner_type',$bannerType)->get();
    	 	$bannerList = array();
    	 	foreach($banners as $key=>$bannerInfo)
    	 	{
    	 		$bannerList[$key]['id'] = $bannerInfo->id;
    	 		$bannerList[$key]['banner_type'] = $bannerInfo->banner_type;
    	 		$bannerList[$key]['title'] = $bannerInfo->title;
    	 		$bannerList[$key]['sub_title'] = $bannerInfo->sub_title;
    	 		$bannerList[$key]['link_text'] = $bannerInfo->link_text;
    	 		$bannerList[$key]['link_url'] = $bannerInfo->link_url;
    	 		$bannerList[$key]['image_url'] = route('viewMacroImage').'?url='.$bannerInfo->image_url;
    	 	}

            if($settingInfo->display_dod=='1')
            {
               // $sectionInfo[]['todayDeal'] = $this->getHomeProducts($settingInfo->dod_title,'todayDeal');
                //$sectionInfo[0]['key'] = 'Today Deal';
                $sectionInfo[] = $this->getHomeProducts($settingInfo->dod_title,'todayDeal');
            } 

            if($settingInfo->display_td=='1')
            {
               // $sectionInfo[]['topDeal'] = $this->getHomeProducts($settingInfo->td_title,'topDeal');
               // $sectionInfo[1]['key'] = 'Top Deal';
                $sectionInfo[] = $this->getHomeProducts($settingInfo->td_title,'topDeal');
            } 
            if(isset($settingInfo->category_1) && !empty($settingInfo->category_1))
            {
                $sectionInfo[] = $this->getHomeProducts($settingInfo->category_1_title,'category',$settingInfo->category_1);
            }
            if(isset($settingInfo->category_2) && !empty($settingInfo->category_2))
            {
                $sectionInfo[] = $this->getHomeProducts($settingInfo->category_2_title,'category',$settingInfo->category_2);
            }
            if(isset($settingInfo->category_3) && !empty($settingInfo->category_3))
            {
                $sectionInfo[] = $this->getHomeProducts($settingInfo->category_3_title,'category',$settingInfo->category_3);
            }
            if(isset($settingInfo->category_4) && !empty($settingInfo->category_4))
            {
                $sectionInfo[] = $this->getHomeProducts($settingInfo->category_4_title,'category',$settingInfo->category_4);
            }
            if(isset($settingInfo->category_5) && !empty($settingInfo->category_5))
            {
                $sectionInfo[] = $this->getHomeProducts($settingInfo->category_5_title,'category',$settingInfo->category_5);
            }

            $data = array(
                    'categories' => $categories,
                    'section' => $sectionInfo, 
                    'banners' => $bannerList,
                    'setting' => $settingInfo, 
                );
               
                $this->apiArray['message'] = 'Success';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = false; 
                $this->apiArray['data'] = $data;  
                return response()->json($this->apiArray, 200); 
                      
        }catch (\Exception $e){
            $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 200);
        }
    }

    protected function getHomeProducts($title='',$type='category',$category_id='')
    {
        $data= array();
        if(empty($title))
        {
            $title = "All Products";
        }
        $data['title'] = $title;
        $data['type']=$type;
        $data['category_id']=$category_id;
        $data['products'] = [];

        $products = array();

            if($data['type']=='category')
            {
                if(!empty($data['category_id']))
                {  
                    $catObj = new Category();
                    $catArray = $catObj->get_child_categories($data['category_id']);
                    $allCategories = array();
                    $allCategories = $this->array_flatten($catArray);
                     
                    $productsArray=CategoryProduct::whereIn('category_id',$allCategories)->pluck('product_id')->toArray();
                    $products = Product::whereIn('id',$productsArray)->where('status',1)->orderby('in_deal','desc')->limit(6)->get(); 
                   // $catInfo=Category::find($inputs['category_id']);
                   // $title = $catInfo->name; 
                }
            }elseif($data['type']=='todayDeal')
            {
                $productQuery = Product::where('status',1);  
                $productQuery = $productQuery->where('today_deal',1); 
                $products = $productQuery->inRandomOrder()->limit(6)->get();
              //  $title = 'Deal of the day';

            }elseif($data['type']=='topDeal')
            {
                $productQuery = Product::where('status',1);  
                $productQuery = $productQuery->where('in_deal',1); 
                $products = $productQuery->inRandomOrder()->limit(6)->get();
               // $title = 'Top deal';
            }elseif($data['type']=='all')
            {
                $products = Product::where('status',1)->inRandomOrder()->limit(6)->get();
              //  $title = 'All Products';
            }

            $productsList = array();

            foreach($products as $key => $productInfo)
            {
                $productsList[$key]['id'] = $productInfo->id;
                $productsList[$key]['name'] = $productInfo->name;
                $productsList[$key]['slug'] = $productInfo->slug;
                $productsList[$key]['sale_price'] = $productInfo->sale_price;
                $productsList[$key]['price'] = $productInfo->price;
                $productsList[$key]['image_url'] = route('viewMacroImage').'?url='.$productInfo->images;
            }

            $data['products'] = $productsList;

        return $data;
    }

    public function homeProducts(Request $request)
    {        
         try{
            $this->apiArray['state'] = 'homeProducts';
             $headers = getallheaders(); 
            /*Check header */
              if (!isset($headers['apiauthkey']) ||  $headers['apiauthkey']!=env('API_AUTH_KEY')){
                $this->apiArray['errorCode'] = 2;
                $this->apiArray['message'] = 'Unauthorized access';
                $this->apiArray['error'] = true;
                $this->apiArray['data'] = null;
                return response()->json($this->apiArray, 200);
            }
            /*End*/

            $inputs = $request->all();            
            $validator = Validator::make($inputs, [
                'type' => 'required', 
            ]);
            if($validator->fails()){
                $this->apiArray['message'] = $validator->messages()->first();
                $this->apiArray['errorCode'] = 3;
                $this->apiArray['error'] = true;
                return response()->json($this->apiArray, 200);
            } 

            $products = array();
            if($inputs['type']=='category')
            {
            	if(empty($inputs['category_id']))
            	{
            		$this->apiArray['message'] = 'The category_id field is required.';
                    $this->apiArray['errorCode'] = 3;
                    $this->apiArray['error'] = false; 
                    $this->apiArray['data'] = NULL;
                    return response()->json($this->apiArray, 200);
            	}

            	$catObj = new Category();
				$catArray = $catObj->get_child_categories($inputs['category_id']);
				$allCategories = array();
				$allCategories = $this->array_flatten($catArray);
				 
				$productsArray=CategoryProduct::whereIn('category_id',$allCategories)->pluck('product_id')->toArray();
				$products = Product::whereIn('id',$productsArray)->where('status',1)->orderby('in_deal','desc')->limit(6)->get(); 
				$catInfo=Category::find($inputs['category_id']);
				$title = $catInfo->name; 
            }elseif($inputs['type']=='todayDeal')
            {
            	$productQuery = Product::where('status',1);  
				$productQuery = $productQuery->where('today_deal',1); 
				$products = $productQuery->inRandomOrder()->limit(6)->get();
				$title = 'Deal of the day';

            }elseif($inputs['type']=='topDeal')
            {
            	$productQuery = Product::where('status',1);  
				$productQuery = $productQuery->where('in_deal',1); 
				$products = $productQuery->inRandomOrder()->limit(6)->get();
				$title = 'Top deal';
            }elseif($inputs['type']=='all')
            {
            	$products = Product::where('status',1)->inRandomOrder()->limit(6)->get();
            	$title = 'All Products';
            }

            $productsList = array();

            foreach($products as $key => $productInfo)
            {
            	$productsList[$key]['id'] = $productInfo->id;
            	$productsList[$key]['name'] = $productInfo->name;
            	$productsList[$key]['slug'] = $productInfo->slug;
            	$productsList[$key]['sale_price'] = $productInfo->sale_price;
            	$productsList[$key]['price'] = $productInfo->price;
            	$productsList[$key]['image_url'] = route('viewMacroImage').'?url='.$productInfo->images;
            }


            $data = array(
            		'title' => $title,
            		//'read_more_link' => $read_more_link,
                    'products'        => $productsList,
                     
                );
               
                $this->apiArray['message'] = 'Success';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = false; 
                $this->apiArray['data'] = $data;  
                return response()->json($this->apiArray, 200); 
                      
        }catch (\Exception $e){
            $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 200);
        }
    } 

    public function testTracking(Request $request)
    {
        try {
            $this->apiArray['state'] = 'testTracking';
            $headers = getallheaders();  
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

            $user_data = User::find(\Auth::guard('api')->id()); 

                    try{ 

                        $awb_number = $this->getShippingAwb();
                        
                        $id = $inputs['id'];

                        if(!empty($awb_number))
                        {
                            $this->shippingManifestAwb($id,$awb_number);
                        }

                    }catch(\Exception $e) {
                        echo $e->getMessage();
                        exit;
                    }

            $response = "Test Tracking API";
            $this->apiArray['data'] = $response;
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

    public function getShippingAwb()
    {
        $shipping_api_username = env('SHIPPING_APP_USERNAME');
        $shipping_api_password = env('SHIPPING_APP_PASSWORD');

        $curl = curl_init(); 
        curl_setopt_array($curl, array(
         // CURLOPT_URL => 'https://clbeta.ecomexpress.in/apiv2/fetch_awb/',
          CURLOPT_URL => 'https://api.ecomexpress.in/apiv2/fetch_awb/',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('username' => $shipping_api_username,'password' => $shipping_api_password,'count' => '1','type' => 'PPD'),
          CURLOPT_HTTPHEADER => array(
            'Cookie: AWSALB=6sNmsZi4z16DbdR9yhQ/zjtZu40slEh9E2CxhJQWVlTMVWNeerkfDZq7NqnIZ15aVhHOaCRB6mTMyqxcvH4ree7+/gsZBLhoV0ukTw5U/PMuV0S4b7YwDNafw7RP; AWSALBCORS=6sNmsZi4z16DbdR9yhQ/zjtZu40slEh9E2CxhJQWVlTMVWNeerkfDZq7NqnIZ15aVhHOaCRB6mTMyqxcvH4ree7+/gsZBLhoV0ukTw5U/PMuV0S4b7YwDNafw7RP'
          ),
        ));

            $response = curl_exec($curl); 

            curl_close($curl);
            $data = json_decode($response); 
            if(isset($data->awb[0]))
            {
                return $data->awb[0];
            }else{
                return null;
            }
    }
    public function shippingManifestAwb($order_id,$awb_number)
    {  
        $shipping_api_username = env('SHIPPING_APP_USERNAME'); 
        $shipping_api_password = env('SHIPPING_APP_PASSWORD');
         
        $orderInfo = Order ::find($order_id); 

        $shippingInfo = json_decode($orderInfo->shipping_address);

        $shipping_name='';
        $address_line_1='';
        $address_line_2='';
        $city='';
        $postcode='';
        $state='';
        $mobile='';
        $telephone='';

        if(isset($shippingInfo->first_name) && isset($shippingInfo->last_name))
        {
            $shipping_name=$shippingInfo->first_name.' '.$shippingInfo->last_name;
        } 

        if(isset($shippingInfo->address_line_1))
        {
            $address_line_1=$shippingInfo->address_line_1;
        }
        if(isset($shippingInfo->address_line_2))
        {
            $address_line_2=$shippingInfo->address_line_2;
        }
        if(isset($shippingInfo->city))
        {
            $city=$shippingInfo->city;
        }
        if(isset($shippingInfo->state))
        {
            $state=$shippingInfo->state;
        }
        if(isset($shippingInfo->postcode))
        {
            $postcode=$shippingInfo->postcode;
        }
        if(isset($shippingInfo->mobile))
        {
            $mobile=$shippingInfo->mobile;
        }
        if(isset($shippingInfo->mobile))
        {
            $mobile=$shippingInfo->mobile;
        } 
        $curl = curl_init();  
        $json_input = array ( 
              'AWB_NUMBER' => (string)$awb_number,                  
              'ORDER_NUMBER' => $orderInfo->order_number,
              'PRODUCT' => 'PPD',
              'CONSIGNEE' => $shipping_name,
              'CONSIGNEE_ADDRESS1' => $address_line_1,
              'CONSIGNEE_ADDRESS2' => $address_line_2,
              'CONSIGNEE_ADDRESS3' => '',
              'DESTINATION_CITY' => $city,
              'PINCODE' => $postcode,
              'STATE' => $state,
              'MOBILE' => $mobile,
              'TELEPHONE' => $telephone,
              'ITEM_DESCRIPTION' => 'Grocery Items',
              'PIECES' => $orderInfo->total_qty,
              'COLLECTABLE_VALUE' => 0,
              'DECLARED_VALUE' => $orderInfo->total_amount,
              'ACTUAL_WEIGHT' => 1,
              'VOLUMETRIC_WEIGHT' => 0.2,
              'LENGTH' => 10,
              'BREADTH' => 8,
              'HEIGHT' => 3,
              'PICKUP_NAME' => 'Macro bazar',
              'PICKUP_ADDRESS_LINE1' => 'MB Godown, Bhura Ji vihar,',
              'PICKUP_ADDRESS_LINE2' => 'Narayan Vihar, Jaipur, Rajasthan,',
              'PICKUP_PINCODE' => '302029',
              'PICKUP_PHONE' => '',
              'PICKUP_MOBILE' => '9783511107',
              'RETURN_NAME' => 'Macro bazar',
              'RETURN_ADDRESS_LINE1' => 'Ground floor, Laxmi Villa, Madhyam Marg,',
              'RETURN_ADDRESS_LINE2' => 'Kaveri Path, Sector 21, Mansarovar,',
              'RETURN_PINCODE' => '302020',
              'RETURN_PHONE' => '',
              'RETURN_MOBILE' => '9783511107',
              'ADDONSERVICE' => 
              array (
                0 => '',
              ),
              'DG_SHIPMENT' => 'false',
              'ADDITIONAL_INFORMATION' => 
              array (
                'essentialProduct' => 'N',
                'OTP_REQUIRED_FOR_DELIVERY' => 'Y',
                'DELIVERY_TYPE' => '',
                'SELLER_TIN' => '',
                'INVOICE_NUMBER' => $orderInfo->order_number,
                'INVOICE_DATE' => date('d-m-Y',strtotime($orderInfo->created_at)),
                'ESUGAM_NUMBER' => '',
                'ITEM_CATEGORY' => '',
                'PACKING_TYPE' => '',
                'PICKUP_TYPE' => '',
                'RETURN_TYPE' => '',
                'CONSIGNEE_ADDRESS_TYPE' => '',
                'PICKUP_LOCATION_CODE' => '',
                'SELLER_GSTIN' => '08ABWFM2136J1ZS',
                'GST_HSN' => '8418',
                'GST_ERN' => '08ABWFM2136J1ZS',
                'GST_TAX_NAME' => 'RJ GST',
                'GST_TAX_BASE' => 18,
                'DISCOUNT' => $orderInfo->discount,
                'GST_TAX_RATE_CGSTN' => 9.0,
                'GST_TAX_RATE_SGSTN' => 9.0,
                'GST_TAX_RATE_IGSTN' => 180,
                'GST_TAX_TOTAL' => 90,
                'GST_TAX_CGSTN' => 90,
                'GST_TAX_SGSTN' => 0,
                'GST_TAX_IGSTN' => 0,
              ),
            );  
        
        curl_setopt_array($curl, array(
         // CURLOPT_URL => 'https://clbeta.ecomexpress.in/apiv2/manifest_awb/',
          CURLOPT_URL => 'https://api.ecomexpress.in/apiv2/manifest_awb/',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('username' => $shipping_api_username,'password' => $shipping_api_password,'json_input' => '['.json_encode($json_input).']'),
          CURLOPT_HTTPHEADER => array(
            'Cookie: AWSALB=p9L6OJFyZgcAn/d/NAY/LyDpkrNxA8+DWRyzVZLfNEaRo7NEUrHV+XGtvyOECtWXL2MvWIHRW5bxrad3CbKMLhlAAyKj1l+xyBpbE/EuQtHmVWPEFWzpmI9zqyQv; AWSALBCORS=p9L6OJFyZgcAn/d/NAY/LyDpkrNxA8+DWRyzVZLfNEaRo7NEUrHV+XGtvyOECtWXL2MvWIHRW5bxrad3CbKMLhlAAyKj1l+xyBpbE/EuQtHmVWPEFWzpmI9zqyQv'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $responseInfo = json_decode($response); 
        
        if(isset($responseInfo->shipments[0]->success) && $responseInfo->shipments[0]->success==1)
        {
            if(isset($responseInfo->shipments[0]->awb) && !empty($responseInfo->shipments[0]->awb))
            {
                Order::where('id',$order_id)->update(['tracking_id' => $responseInfo->shipments[0]->awb]);
            }
        }  
    }
    
    
}
