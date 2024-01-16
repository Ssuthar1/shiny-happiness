<?php

namespace App\Http\Livewire\Frontend\Old;

use Livewire\Component;
use App\Models\Product;
use App\Models\User;
use App\Models\Category; 
use App\Models\CartItem;
use Carbon\Carbon;
use Auth ,Config;

class ProductComponent extends Component
{

   // protected $listeners = ['refresh-cart' => 'refreshCart'];
    public $products=[],$product_id;
    public function mount(){
        if(isset($this->products->id))
        {
            $this->product_id = $this->products->id;
        }
        
    }
    
    public function render()
    {
    	 
        return view('livewire.frontend.product');
    }
     
    public function setQuantity($action)
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
        $product_exist = CartItem::where('user_id',$user_id)->where('product_id',$this->product_id)->first();
        if($product_exist)
        {
            $quantity = $this->selected_quantity;
            $total = $product_exist->rate * $quantity; 
            $product_exist->update(['quantity'=>$quantity, 'total'=>$total]);
        }
    }
    public function addToCart()
    {

        if(Auth::check())
        {
            $user_id=Auth::user()->id; 
            $product_exist = CartItem::where('user_id',$user_id)->where('product_id',$this->product_id)->first();
            if($product_exist)
            {
                $quantity = $product_exist->quantity+1;
                $total = $product_exist->rate * $quantity; 
                $product_exist->update(['quantity'=>$quantity, 'total'=>$total]);
            }else{

                $dbObj = new CartItem; 
                $dbObj->user_id = $user_id;  
                $dbObj->product_id = $this->product_id;
                $dbObj->product_name  =  $this->products->name;
                $dbObj->quantity = 1;
                $dbObj->rate = $this->products->final_sale_price;
                $dbObj->total = $this->products->final_sale_price; 
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