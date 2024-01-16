<?php

namespace App\Http\Livewire\Frontend\Old;

use Livewire\Component;
use App\Models\Product;
use App\Models\User; 
use App\Models\CartItem; 
use Carbon\Carbon;
use Auth ,Config;

class TopCart extends Component
{
     
    public $total_item,$cartTotal=0,$location;

    protected $listeners = ['refresh-cart' => 'refreshCart','remove-cart-item' => 'removeCartItem'];
     
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
            $this->dispatchBrowserEvent('updateCartItem', [
                    'total_item' => $this->total_item,  
                ]);
        }else
        { 
            $this->total_item=0;
        }
        return view('livewire.frontend.home.top-cart',compact('cartItems'));
    }
    public function removeCartItem($cartItemId)
    {
        $user_id=Auth::user()->id;  
        
        CartItem::where('user_id',$user_id)->where('id',$cartItemId)->delete();
        $this->refreshCart();
        $this->dispatchBrowserEvent('toast:cartSuccess', [
                    'icon' => 'success',  
                    'title' => __("Success"),
                    'text' => __("Success : Product removed from cart!"), 
                ]);

    }
    public function refreshCart()
    {
        if(Auth::check())
        {
            $user_id=Auth::user()->id;
            $this->total_item=CartItem::where('user_id',$user_id)->count();
        }else
        {
            //$session_id = session_id();
            //$this->total_item=CartItem::where('session_id',$session_id)->count();
        }
        $this->dispatchBrowserEvent('updateCartItem', [
                    'total_item' => $this->total_item,  
                ]);
    }

    

   
}