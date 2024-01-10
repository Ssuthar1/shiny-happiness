<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
//use Illuminate\View\View;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Spatie\Permission\Models\Role; 
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\View;
use App\Models\Booking;
use App\Models\PaymentInformation;
use Config;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request) 
    {
        $module = 'dashboard'; 
        View::share('module', $module);

        $data=array();
        $data['module_title']="Dashboard";
        $user = Auth::user();

        $totalDepositAmount = $thisMonthDeposit = $totalBooking = $thisMonthBooking = 0;
        $totalDepositAmount = PaymentInformation::where('status','Completed')->get('amount')->sum('amount');
        $thisMonthDeposit = PaymentInformation::where('status','Completed')->whereMonth('created_at', Carbon::now()->month)->get('amount')->sum('amount');
        $totalBooking = Booking::count();
        $thisMonthBooking = Booking::whereMonth('created_at', Carbon::now()->month)->count();
        // dd($totalDepositAmount , $thisMonthDeposit , $totalBooking , $thisMonthBooking);

        $data['totalDepositAmount']     =   $totalDepositAmount;
        $data['thisMonthDeposit']       =   $thisMonthDeposit;
        $data['totalBooking']           =   $totalBooking;
        $data['thisMonthBooking']       =   $thisMonthBooking;
        return view('dashboard',$data);
    } 

    public function users(Request $request) 
    {
        $module = 'users'; 
        $type= "customers";
        if($request->type)
        {
            $type=$request->type;
        }
        View::share('module', $module);
        
        $data=array();
        $data['module_title']="Users"; 
        $data['type']=$type; 
        return view('dashboard.users.index',$data);
    }
    public function rolesPermissions(Request $request)
    {

        /// Create Roles & Permissions if not exist
         $permissionList = Config::get('global.permissions');
         $rolesList = Config::get('global.roles');
         foreach($permissionList as $permissionName)
         {
            Permission::firstOrCreate(['name' => $permissionName]);
         }
         foreach($rolesList as $roleName)
         {
            Role::firstOrCreate(['name' => $roleName]);
         }
        /// End of Create Permission if not exist 

        $module = 'rolesPermissions'; 
        View::share('module', $module);

        $roles = Role::get();
 
        
        $data=array();
        $data['module_title']="Roles & Permissions"; 
        return view('dashboard.roles-permissions.index',$data);
    }

    /* Deposit Listing Function Start*/
    public function bookingList(Request $request) 
    {
        $module = 'bookingList'; 
        View::share('module', $module); 
        $data   = array();
        $data['module_title']="Bookings"; 
        return view('dashboard.bookings.index',$data);
    }
    /* Deposit Listing End */

    /* Account Listing Function Start*/
    public function paymentInformation(Request $request) 
    {
        $module = 'paymentInformation'; 
        View::share('module', $module); 
        $data   = array();
        $data['module_title']="Payment Information"; 
        return view('dashboard.payment-informations.index',$data);
    }
    /* Account Listing End */
}
