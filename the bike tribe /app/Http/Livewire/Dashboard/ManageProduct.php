<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;  
use Livewire\WithPagination;
use Illuminate\Auth\Events\Registered;
use App\Rules\UniqueEmailWithSoftDelete;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;

class ManageProduct extends Component
{
	use WithPagination;  
    public $mode="list";
    public $name,$email,$mobile_no,$password,$password_confirmation;

 	protected $rules = [ 
        'name' => 'required', 
    ];

    //protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        if($this->type=='subadmin')
        {
           $this->userrole =  'Admin';
        }
    }
    public function render()
    {
        
        $users = User::role($this->userrole)->orderBy('id','desc')->paginate();  

        return view('livewire.dashboard.users.index',compact('users'));
    }
    public function resetUser()
    {
        $this->mode = "list";
        $this->name = "";
        $this->email = "";
        $this->mobile_no = "";
        $this->password = "";
        $this->password = "";

    }
    
    public function addUser()
    {
        $this->mode = "add";
    }
    public function storeUser(Request $request)
    {
        $inputs = $this->validate();

       /* $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', new UniqueEmailWithSoftDelete],
            // Other validation rules
        ]);*/

        /// Generating Unique User ID 
       
        /// End of Generating Unique User ID 

        $userInfo = array();
        $userInfo['name'] = $inputs['name'];
        $userInfo['email'] = $this->email;
        $userInfo['mobile_no'] = $inputs['mobile_no'];
        $password = generateRandomString(10);
        $userInfo['password'] = bcrypt($password);
        $userInfo['status'] = 1;
        $user = User::create($userInfo); 

        $user->assignRole($this->userrole);

        event(new Registered($user));
        
        $this->resetUser();
        $this->dispatchBrowserEvent('swal:success', [
                    'icon' => 'success',  
                    'title' => __("Success"),
                    'text' => __("User added successfully."), 
                ]);

    }
    public function updateStatus($action,$id)
    {
        User::where('id',$id)->update(['status'=>$action]);
         
        $this->dispatchBrowserEvent('swal:success', [
                    'icon' => 'success',  
                    'title' => __("Success"),
                    'text' => __("User status updated successfully."), 
                ]);
    }

    public function deleteUser($user_id)
    {
        if(!empty($user_id))
        { 
            User::where('id',$user_id)->delete();
        }
        
        $this->dispatchBrowserEvent('swal:success', [
                    'icon' => 'success',  
                    'title' => __("Success"),
                    'text' => __("User deleted successfully."), 
                ]);
    }
}
