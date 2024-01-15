<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Product;
use App\Models\User; 
use App\Models\CartItem; 
use Carbon\Carbon;
use Auth ,Config;

class HomeProducts extends Component
{
     
    public $total_item,$cartTotal=0,$location,$type,$title,$category_id;  

    public function mount(){
        
    }
    
    public function render()
    {
      	$data = array();   
      	$productList = Product::where('status','1');

        if($this->type=='top_rated')
        {
            $productList = $productList->where('is_top_rated',1);
        }
        if($this->type=='new_arrivals')
        {
            $productList = $productList->where('is_new_arrival',1);
        }
        if($this->type=='best_selling')
        {
            $productList = $productList->where('is_bestselling',1);
        } 
        if($this->type=='latest')
        {
            $productList = $productList->where('is_latest',1);
        } 
        $productList = $productList->inRandomOrder()->limit(10)->get();

        return view('livewire.frontend.home-products',compact('productList'));
    }

    public function setQuantity($action,$product_id)
    {
        if($action=='add')
        {
            $this->selected_quantity= $this->selected_quantity+1;
        }
        if($action=='remove')
        {
           if($this->selected_quantity>1)
           {
            $this->selected_quantity = $this->selected_quantity -1;
           }else
           {
            $this->selected_quantity = 1;
           } 
        }
        $user_id=Auth::user()->id;  
        $product_exist = CartItem::where('user_id',$user_id)->where('product_id',$product_id)->first();
        if($product_exist)
        {
            $quantity = $this->selected_quantity;
            $total = $product_exist->rate * $quantity; 
            $product_exist->update(['quantity'=>$quantity, 'total'=>$total]);
        }
    }
    public function addToCart($product_id,$type)
    {
    	$productInfo = Product::find($product_id);
        if(Auth::check())
        {
            $user_id=Auth::user()->id; 
            $product_exist = CartItem::where('user_id',$user_id)->where('product_id',$product_id)->first();
            if($product_exist)
            {
                $quantity = $product_exist->quantity+1;
                $total = $product_exist->rate * $quantity; 
                $product_exist->update(['quantity'=>$quantity, 'total'=>$total]);
            }else{

                $dbObj = new CartItem; 
                $dbObj->user_id = $user_id;  
                $dbObj->product_id = $product_id;
                $dbObj->product_name  =  $productInfo->name;
                $dbObj->quantity = 1;
                $dbObj->rate = $productInfo->final_sale_price;
                $dbObj->total = $productInfo->final_sale_price; 
                $dbObj->save();
            } 
            $this->dispatch('refresh-cart');
            $this->dispatchBrowserEvent('toast:cartSuccess', [
                    'icon' => 'success',  
                    'title' => __("Success"),
                    'text' => __("Success : Product added in cart!"), 
                ]);
        }else{
            $this->dispatch('login-account');
        }
       

    }
   

    

   
}