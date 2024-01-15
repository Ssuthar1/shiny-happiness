<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Product;
use App\Models\User;
use Livewire\WithPagination;
use App\Models\Category; 
use App\Models\CategoryProduct;  
use Carbon\Carbon;
use Auth ,Config;

class ShopComponent extends Component
{
     use WithPagination;
    public $selectedCatInfo,$totalCartItem,$location,$categorySlug,$filterCategories=array(),$filterProducts=array(),$searchkey;
    public $categories = [];
    
    public function mount(){

        $selectedCatInfo = Category::where('slug',$this->categorySlug)->first();
        $this->selectedCatInfo = $selectedCatInfo;
        if(isset($selectedCatInfo))
        {
            //$this->filterCategories[] = $selectedCatInfo->id;
            $this->setCategoriesFilter($selectedCatInfo->id);
        } 
    } 
    public function render()
    {
    	$cartItems = array();
        $productList = Product::where('status','1');
        if(count($this->filterCategories)>0)
        {
            $productList = $productList->whereIn('id',$this->filterProducts);
        }
        if(!empty($this->searchkey))
        {
            $productList = $productList->where('name','LIKE','%'.$this->searchkey.'%') ;
        } 
         

        $productList = $productList->orderBy('id','DESC')->paginate(12);
         
        return view('livewire.frontend.shop',compact('productList'));
    }
    public function setCategoriesFilter($category_id)
    {
        if(in_array($category_id,$this->filterCategories))
        {
             $tempCategory = $this->filterCategories;
             $this->filterCategories = array();
             foreach($tempCategory as $categoryId)
             {
                if($category_id!=$categoryId)
                {
                    $this->filterCategories[] = $categoryId;
                } 
             }
        }else
        {
            $this->filterCategories[] = $category_id;
        }
       
    $this->filterProducts = CategoryProduct::whereIn('category_id',$this->filterCategories)
    ->pluck('product_id')
    ->toArray();

    }

    

    

   
}