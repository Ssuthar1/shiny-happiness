<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Size; 
use App\Models\CategoryProduct; 
use App\Models\SiteSetting;
use Exception, Validator,DB;
use App\Traits\VerifyTokenStatus;

class ProductController extends Controller
{
    use VerifyTokenStatus;

    public function __construct()
    {
        $this->apiArray = array();
        $this->apiArray['error'] = true;
        $this->apiArray['message'] = '';
        $this->apiArray['errorCode'] = 1;

    
    }

    public function details(Request $request)
    {        
        try {
            $this->apiArray['state'] = 'getProductDetails';
             $headers = getallheaders(); 
             /*Check header  
              if (!isset($headers['apiauthkey']) ||  $headers['apiauthkey']!=env('API_AUTH_KEY')){
                $this->apiArray['errorCode'] = 1;
                $this->apiArray['message'] = 'Unauthorized access';
                $this->apiArray['error'] = true;
                $this->apiArray['data'] = null;
                return response()->json($this->apiArray, 200);
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

            $product_data = Product::where('status',1)->where('id',$request->id)->first();

            if(!empty($product_data)){
            	
                $product_data['images'] = route('viewMacroImage').'?url='.$product_data->images;
                $other_images = [];
                $other_images = json_decode($product_data->other_images);
                $product_images = array();
                if(count($other_images))
                {
                    foreach($other_images as $otherImage)
                    {
                         $product_images[] =  route('viewMacroImage').'?url='.$otherImage;
                    }
                }
                $product_data['other_images'] =  $product_images;
              //  $product_data['other_images'] = json_decode($product_data->other_images); 


                $this->apiArray['data'] = $product_data;
                $this->apiArray['message'] = 'Success';
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = false;
                return response()->json($this->apiArray, 200);
            }
               else
            {
                $this->apiArray['data'] = NULL;
                $this->apiArray['message'] = 'Product not found';
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

    public function categoryProduct(Request $request)
    {
        try{
                $this->apiArray['state'] = 'categoryProducts';
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

                $inputs = $request->all();            
                $validator = Validator::make($inputs, [
                     'id' => 'required', 
                ]);
                if($validator->fails()){
                    $this->apiArray['message'] = $validator->messages()->first();
                    $this->apiArray['errorCode'] = 3;
                    $this->apiArray['error'] = true;
                    return response()->json($this->apiArray, 200);
                } 

                if(!isset($inputs['paged']))
                {
                    $inputs['paged'] = 1;
                }

                $filterBrands=[];
                $filterCategories=[];
                $filterColors=[];
                $filterSizes=[];
                $orderby='latest';

                if(isset($inputs['brands']))
                {
                   $filterBrands = explode(',',$inputs['brands']); 
                } 
                if(isset($inputs['categories']))
                {
                   $filterCategories = explode(',',$inputs['categories']); 
                } 
                if(isset($inputs['colors']))
                {
                   $filterColors = explode(',',$inputs['colors']); 
                } 
                if(isset($inputs['sizes']))
                {
                   $filterSizes = explode(',',$inputs['sizes']); 
                } 
                if(isset($inputs['orderby']))
                {
                    $orderby = $inputs['orderby'];
                }

                $products = $this->getProducts($request,'category',$inputs['id'],$inputs['paged'],$filterBrands,$filterCategories,$filterColors,$filterSizes,$orderby);
                $filters = $this->getProductsFilters($inputs['id']);
                
                $data = array( 
                    'filters'  => $filters,
                    'productInfo' => $products,
                     
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
    public function searchProduct(Request $request)
    {
         try{
                $this->apiArray['state'] = 'searchProducts';
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

                $inputs = $request->all();            
                $validator = Validator::make($inputs, [
                     'searchkey' => 'required', 
                ]);
                if($validator->fails()){
                    $this->apiArray['message'] = $validator->messages()->first();
                    $this->apiArray['errorCode'] = 3;
                    $this->apiArray['error'] = true;
                    return response()->json($this->apiArray, 200);
                } 

                if(!isset($inputs['paged']))
                {
                    $inputs['paged'] = 1;
                }
                $filterBrands=[];
                $filterCategories=[];
                $filterColors=[];
                $filterSizes=[];
                $orderby='latest';

                if(isset($inputs['brands']))
                {
                   $filterBrands = explode(',',$inputs['brands']); 
                } 
                if(isset($inputs['categories']))
                {
                   $filterCategories = explode(',',$inputs['categories']); 
                } 
                if(isset($inputs['colors']))
                {
                   $filterColors = explode(',',$inputs['colors']); 
                } 
                if(isset($inputs['sizes']))
                {
                   $filterSizes = explode(',',$inputs['sizes']); 
                } 
                if(isset($inputs['orderby']))
                {
                    $orderby = $inputs['orderby'];
                } 
                 
                $products = $this->getProducts($request,'search','',$inputs['paged'],$filterBrands,$filterCategories,$filterColors,$filterSizes,$orderby,$inputs['searchkey']);
                $filters = $this->getProductsFilters();
                $data = array( 
                    'filters'  => $filters,
                    'productInfo' => $products,
                     
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
    public function topDealProduct(Request $request)
    {
         try{
                $this->apiArray['state'] = 'topDealProducts';
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

                $inputs = $request->all();            
                $validator = Validator::make($inputs, [
                    // 'searchkey' => 'required', 
                ]);
                if($validator->fails()){
                    $this->apiArray['message'] = $validator->messages()->first();
                    $this->apiArray['errorCode'] = 3;
                    $this->apiArray['error'] = true;
                    return response()->json($this->apiArray, 200);
                } 

                if(!isset($inputs['paged']))
                {
                    $inputs['paged'] = 1;
                }

                $filterBrands=[];
                $filterCategories=[];
                $filterColors=[];
                $filterSizes=[];
                $orderby='latest';

                if(isset($inputs['brands']))
                {
                   $filterBrands = explode(',',$inputs['brands']); 
                } 
                if(isset($inputs['categories']))
                {
                   $filterCategories = explode(',',$inputs['categories']); 
                } 
                if(isset($inputs['colors']))
                {
                   $filterColors = explode(',',$inputs['colors']); 
                } 
                if(isset($inputs['sizes']))
                {
                   $filterSizes = explode(',',$inputs['sizes']); 
                } 
                if(isset($inputs['orderby']))
                {
                    $orderby = $inputs['orderby'];
                }
                 
                $products = $this->getProducts($request,'topDeals','',$inputs['paged'],$filterBrands,$filterCategories,$filterColors,$filterSizes,$orderby);
                $filters = $this->getProductsFilters();
                $data = array( 
                    'filters'  => $filters,
                    'productInfo' => $products,
                     
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
    public function todayDealProduct(Request $request)
    {
         try{
                $this->apiArray['state'] = 'todayDealProducts';
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

                $inputs = $request->all();            
                $validator = Validator::make($inputs, [
                    // 'searchkey' => 'required', 
                ]);
                if($validator->fails()){
                    $this->apiArray['message'] = $validator->messages()->first();
                    $this->apiArray['errorCode'] = 3;
                    $this->apiArray['error'] = true;
                    return response()->json($this->apiArray, 200);
                } 

                if(!isset($inputs['paged']))
                {
                    $inputs['paged'] = 1;
                }

                $filterBrands=[];
                $filterCategories=[];
                $filterColors=[];
                $filterSizes=[];
                $orderby='latest';

                if(isset($inputs['brands']))
                {
                   $filterBrands = explode(',',$inputs['brands']); 
                } 
                if(isset($inputs['categories']))
                {
                   $filterCategories = explode(',',$inputs['categories']); 
                } 
                if(isset($inputs['colors']))
                {
                   $filterColors = explode(',',$inputs['colors']); 
                } 
                if(isset($inputs['sizes']))
                {
                   $filterSizes = explode(',',$inputs['sizes']); 
                } 
                if(isset($inputs['orderby']))
                {
                    $orderby = $inputs['orderby'];
                }
                 
                $products = $this->getProducts($request,'dayDeals','',$inputs['paged'],$filterBrands,$filterCategories,$filterColors,$filterSizes,$orderby);
                $filters = $this->getProductsFilters();

                $data = array( 
                    'filters'  => $filters,
                    'productInfo' => $products,
                     
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

    protected function getProducts(Request $request,$type='search',$category_id='',$paged=1,$filterBrands=[],$filterCategories=[],$filterColors=[],$filterSizes=[],$orderby='latest',$searchkey='')
    {
        $products = new Product;
        if($type=='dayDeals')
        {
            $products = $products->where('today_deal',1);
        }elseif($type=='topDeals')
        {
            $products = $products->where('in_deal',1);
        }elseif($type=='category')
        {
            $productsArray=CategoryProduct::where('category_id',$category_id)->pluck('product_id')->toArray();  
            $products = $products->whereIn('id',$productsArray);
        }elseif($type=='search')
        { 
            $products = $products->where('name','like','%'.$searchkey.'%');
        }

        /// Set Brand Filter

        if(count($filterBrands)>0)
        {             
            $products = $products->whereIn('brand_id',$filterBrands);
        }
        /// Set Categories Filter
        if(count($filterCategories)>0)
        {
            $categoryProducts=CategoryProduct::whereIn('category_id',$filterCategories)->pluck('product_id')->toArray();
            $products = $products->whereIn('id',$categoryProducts); 
        }
        /// Set Colors Filter
        if(count($filterColors)>0)
        {
            $colorProducts = ProductInventory::whereIn('color_id',$filterColors)->pluck('product_id')->toArray(); 
            $products = $products->whereIn('id',$colorProducts);
        }
        /// Set Size Filter
        if(count($filterSizes)>0) 
        {
                $sizeProducts = ProductInventory::whereIn('size_id',$filterSizes)->pluck('product_id')->toArray(); 
                $products = $products->whereIn('id',$sizeProducts);
        }

        $sortorder='in_deal';
        $order='desc';
        if($orderby=='latest')
        {
            $sortorder='id';
        }elseif($orderby=='name_asc')
        {
            $sortorder='name';
            $order='asc';
        }elseif($orderby=='name_desc')
        {
            $sortorder='name';
            $order='desc';
        }elseif($orderby=='price_asc')
        {
            $sortorder='price';
            $order='asc';
        }elseif($orderby=='price_desc')
        {
            $sortorder='price';
            $order='desc';
        }  

        $products = $products->where('status',1)->orderby($sortorder,$order)->paginate(16); 
      /*  echo $products->total();
        echo $products->
        exit;

        echo $products->currentPage();
       echo "<pre>";
       print_r($products);
       exit;   */

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
            $productInfo = array();
            $productInfo['current_page'] = $products->currentPage();
            $productInfo['per_page'] = $products->perPage();
            $productInfo['total'] = $products->total();
            $productInfo['products'] = $productsList;
        return $productInfo;
    }
    protected function getProductsFilters($category_id='')
    {
        $data = array();

        if(!empty($category_id))
        {
            $productsArray=CategoryProduct::where('category_id',$category_id)->pluck('product_id')->toArray(); 
            $catInfo=Category::find($category_id); 
            $brandList = Product::whereIn('id',$productsArray)->pluck('brand_id')->toArray(); 
            $brands = Brand::select('id','name')->whereIn('id',$brandList)->where('status',1)->orderby('name','asc')->get(); 
        }else{
            $brands = Brand::select('id','name')->where('status',1)->orderby('name','asc')->get();
            $categories = Category::select('id','name')->where('status',1)->orderby('name','asc')->get();
        }
        $colors = Color::select('id','title')->orderby('title','asc')->get();
        $sizes = Size::select('id','title')->orderby('title','asc')->get();

        $data['brands'] = $brands;
        if(isset($categories) && !empty($categories))
        {
            $data['categories'] = $categories;
        }else
        {
            $data['categories'] = [];
        }
        
        $data['colors'] =  $colors;
        $data['sizes']  =  $sizes;

        return $data;
    }
}
