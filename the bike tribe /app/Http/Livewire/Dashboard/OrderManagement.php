<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Traits\UploadTraits;
use Carbon\Carbon;
use Auth ,Config;

class OrderManagement extends Component
{
    use WithPagination,UploadTraits,WithFileUploads;
    public $startDate = '',$endDate = '',$s,$parent_id,$buttonText = "Update";
    protected $queryString = ['s','startDate','endDate'];
    public $pageType = 'index',$type,$orderInfo;
    public function mount(){
        $this->startDate = Carbon::now()->subDays(5)->startOfDay()->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfDay()->format('Y-m-d');
    }
    
    public function render()
    {
        $userInfo = Auth::user();
        $data = [];
        if (!empty($this->startDate) && !empty($this->endDate)) {
            $startTime = $this->startDate.' 00:00:00';
            $endTime = $this->endDate.' 23:59:59';
            $data = Order::whereBetween('created_at', [$startTime, $endTime]);
            if (!empty($this->s)) {
                $data = $data->whereHas('getUserDetail', function($o){
                    $o->where('name', 'LIKE' , '%' . trim($this->s) . '%')
                    ->orWhere('email', 'LIKE' , '%' . trim($this->s) . '%')
                    ->orWhere('mobile_no', 'LIKE' , '%' . trim($this->s) . '%');
                });
            }
            if (!empty($this->type) && $this->type == 'cancel') {
                $data = $data->where('status','Cancel');
            }elseif(!empty($this->type) && $this->type == 'pending'){
                $data = $data->where('status','Pending');
            }elseif(!empty($this->type) && $this->type == 'out-delivery'){
                $data = $data->where('status','Out For Delivery');
            }elseif(!empty($this->type) && $this->type == 'complete'){
                $data = $data->where('status','Reached Destination');
            }
            $data = $data->with('getUserDetail')->orderBy('id','DESC')->paginate(10);
        }
        return view('livewire.dashboard.orders.index',compact('data'));
    }

    public function orderDetail($id){
        $this->orderInfo            = Order::where('id',$id)->first();
        $this->pageType             = 'detail';
    }

    public function cancel(){
        $this->reset('orderInfo','pageType');
    }

    public function deleteOrder($id){
        if (!empty($id)) {
            $delete = Order::where('id',$id)->delete();
            return session()->flash('success', 'Order delete successfully.');
        }
    }

    
    public function updateStatus($action,$id)
    {
        Order::where('id',$id)->update(['status'=>$action]);
         
        $this->dispatchBrowserEvent('swal:success', [
                    'icon' => 'success',  
                    'title' => __("Success"),
                    'text' => __("Order status updated successfully."), 
                ]);
    }


}