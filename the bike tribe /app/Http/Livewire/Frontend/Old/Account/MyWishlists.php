<?php

namespace App\Http\Livewire\Frontend\Account;

use Livewire\Component;
use App\Models\Product;
use App\Models\User; 
use App\Models\CartItem; 
use Carbon\Carbon;
use Auth,Config;

class MyWishlists extends Component
{
     
    public $total_item,$cartTotal=0,$location; 
  

    public function mount(){
        
    }
    
    public function render()
    {
      	$data = array();   
        return view('livewire.frontend.account.my-wishlists',compact('data'));
    }
    public function addToCart($id)
    {
        $productInfo = Product::find($id);
        $user_id=Auth::user()->id; 
            $product_exist = CartItem::where('user_id',$user_id)->where('product_id',$id)->first();
            if($product_exist)
            {
                $quantity = $product_exist->quantity+1;
                $total = $product_exist->rate * $quantity; 
                $product_exist->update(['quantity'=>$quantity, 'total'=>$total]);
            }else{

                $dbObj = new CartItem; 
                $dbObj->user_id = $user_id;  
                $dbObj->product_id = $productInfo->id;
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
    }

    

   
}