<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Product;
use App\Models\User; 
use App\Models\CartItem; 
use Carbon\Carbon;
use Auth ,Config;

class CartComponent extends Component
{
     
    public $total_item,$cartTotal=0,$location,$cartGrandTotal=0,$deliveryCharge=40,$taxPer=5,$total_tax=0;

  //  protected $listeners = ['refresh-cart' => 'refreshCart'];

    public function mount(){
        
    }
    
    public function render()
    {
        $cartItems = array();
    	if(Auth::check())
        {
            $user_id=Auth::user()->id; 
            $cartItems = CartItem::where('user_id',$user_id)->get(); 
            $this->total_item = count($cartItems);
        }else
        { 
            $this->total_item=0;
        }
        return view('livewire.frontend.cart',compact('cartItems'));
    }
    public function setQuantity($action,$product_id,$quantity=1)
    {
        if($action=='add')
        {
            $quantity = $quantity+1;
        }
        if($action=='remove')
        {
           if($quantity>1)
           {
            $quantity = $quantity -1;
           }else
           {
            $quantity = 1;
           } 
        }
        $user_id=Auth::user()->id;  
        $product_exist = CartItem::where('user_id',$user_id)->where('product_id',$product_id)->first();
        if($product_exist)
        {
            //$quantity = $this->selected_quantity;
            $total = $product_exist->rate * $quantity; 
            $product_exist->update(['quantity'=>$quantity, 'total'=>$total]);
        }
    }

    public function removeItem($cartItemId)
    { 
        $user_id=Auth::user()->id;  
        
        CartItem::where('user_id',$user_id)->where('id',$cartItemId)->delete();
        $this->dispatch('refresh-cart');
        $this->dispatchBrowserEvent('toast:cartSuccess', [
                    'icon' => 'success',  
                    'title' => __("Success"),
                    'text' => __("Success : Product removed from cart!"), 
                ]);
    }
   

    

   
}