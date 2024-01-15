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
use App\Models\Setting;
use App\Models\Tour; 
use App\Models\Destination; 
use App\Models\Subscriber; 
use App\Models\User; 
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
        $data['totalUsers'] = 0;
        $data['totalDestinations'] = Destination::where('status',1)->count();
        $data['totalTours'] = Tour::where('status',1)->count();
        $data['totalBooking'] = 0;
        $data['totalSubscriber'] = Subscriber::count();
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

    /* Subscribers Function Start*/
    public function subscribers(Request $request) 
    {
        $module = 'subscribers'; 
        View::share('module', $module); 
        $data   = array();
        $data['module_title']="Subscribers"; 
        return view('dashboard.subscribers.index',$data);
    }
    /* Subscribers Listing End */
    

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


    /* Website Settings Function Start*/
    public function config(Request $request) 
    {
        $module = 'config'; 
        View::share('module', $module); 
        $data=array();
        $data['module_title']="Config"; 
        return view('dashboard.config.index',$data);
    }
    /* Website Settings End */
    
    /* Setting Function Start*/
    public function setting(Request $request){
        $module = 'setting'; 
        View::share('module', $module); 
        $data   = array();
        $data['module_title']="Setting";
        $module='Setting'; 


        /// Create Option Type if not exist
         $settingOptionType = Config::get('global.settingOptionType');
         if (isset($settingOptionType) && !empty($settingOptionType)) {
             foreach ($settingOptionType as $key => $settingValue) {
                $data                   = [];
                $data['option_type']    = $settingValue['option_type'];
                $data['option_name']    = $settingValue['option_name'];
                $data['option_key']     = $key;                
                $data['special_option'] = (isset($settingValue['special_option']) && !empty($settingValue['special_option'])) ? $settingValue['special_option'] : '';
                $data['is_hide']        = (isset($settingValue['is_hide']) && !empty($settingValue['is_hide'])) ? $settingValue['is_hide'] : 0;
                Setting::firstOrCreate(['option_key'=>$key],$data);
             }
         }
        /// End of  Option Type if not exist 

        return view('dashboard.settings.index',compact('module'));
    }
    /* Setting Function End*/
    


    public function adminModules(Request $request,$module)
    { 
        $data = array();
        $data['module'] = $module;
        $data['module_title'] = ucwords(str_ireplace('-',' ', $module));
        return view('dashboard.module_container',$data);
    }

    
    

}
