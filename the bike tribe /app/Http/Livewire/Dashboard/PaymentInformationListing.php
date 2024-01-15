<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Booking;
use App\Models\PaymentInformation;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Carbon\Carbon;
use Auth , Config;

class PaymentInformationListing extends Component
{
    use WithPagination; 
    // protected $paginationTheme = 'bootstrap';
    public $startDate = '',$endDate = '',$s,$reportXlsxData = [] , $plan , $planList = [];
    protected $queryString = ['s' , 'plan','startDate','endDate'];
    
    public function mount()
    {
        $this->startDate = Carbon::now()->startOfDay()->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfDay()->format('Y-m-d');
        $this->planList = Config::get('global.planInfo');
    }

    public function render()
    {
        $userInfo = Auth::user();
        $total = 0; 
        if(!empty($this->startDate) && !empty($this->endDate))
        {
            $total = PaymentInformation::when(!empty($this->startDate) && !empty($this->endDate), function ($query) { 
                $startTime = $this->startDate.' 00:00:00';
                $endTime = $this->endDate.' 23:59:59';
                return $query->whereBetween('created_at', [$startTime, $endTime]);
            })
            ->sum('amount');
        } 
        $data = [];
        if (!empty($this->startDate) && !empty($this->endDate)) {
            $startTime = $this->startDate.' 00:00:00';
            $endTime = $this->endDate.' 23:59:59';
            $data = PaymentInformation::whereBetween('created_at', [$startTime, $endTime]);
            if (!empty($this->s)) {
                $data = $data->whereHas('getBookingDetail' ,function ($t)
                {
                    $t->where('booking_id',trim($this->s));
                });
            }
            if (!empty($this->plan)) {
                $data = $data->whereHas('getBookingDetail' ,function ($t)
                {
                    $t->where('plan_id',trim($this->plan));
                });
            }
            $data = $data->with('getBookingDetail')->orderBy('id','DESC')->paginate(10);
        }
        return view('livewire.dashboard.payment-informations.index',compact('data','total'));
    }


    
}













