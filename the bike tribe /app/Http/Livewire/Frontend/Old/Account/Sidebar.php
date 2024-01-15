<?php

namespace App\Http\Livewire\Frontend\Account;

use Livewire\Component;
use App\Models\Product;
use App\Models\User; 
use App\Models\CartItem; 
use Carbon\Carbon;
use Auth ,Config;

class Sidebar extends Component
{
     
    public $total_item,$cartTotal=0,$location;

  //  protected $listeners = ['refresh-cart' => 'refreshCart'];

    public function mount(){
        
    }
    
    public function render()
    {
      	$data = array();   
        return view('livewire.frontend.account.sidebar',compact('data'));
    }
   

    

   
}