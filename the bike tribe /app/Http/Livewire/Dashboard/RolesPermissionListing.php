<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Spatie\Permission\Models\Role; 
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;  
use Livewire\WithPagination;
use Session;

class RolesPermissionListing extends Component
{
	use WithPagination; 
	public $mode="",$selected_role,$selectedPermissions=array();
	//public $excludePermissions=['roles-list','roles-create','roles-edit','roles-delete'];
    public $excludePermissions=[];
    //protected $paginationTheme = 'bootstrap';

    public function render()
    {
    	$roles = Role::where('name','!=','Super Admin')->withCount('users')->get();

    	$selectedRoleInfo = array();
    	$allPermissions = array();
    	if(!empty($this->selected_role))
    	{
    		$selectedRoleInfo = Role::where('id',$this->selected_role)->withCount('users')->first(); 
    		$allPermissions = Permission::whereNotIn('name',$this->excludePermissions)->get();
    		 
    		
    	}
    	
        return view('livewire.dashboard.roles-permissions.index',compact('roles','selectedRoleInfo','allPermissions'));
    }
    public function back()
    {
    	$this->mode="";
    	$this->selected_role = NULL;
    }
    public function editPermission($roleID)
    {
    	$this->mode="update-permission";
    	$this->selected_role = $roleID; 
    	$this->selectedPermissions = [];
        $selectedRoleInfo = Role::where('id',$this->selected_role)->withCount('users')->first();
        $allPermissions = Permission::whereNotIn('name',$this->excludePermissions)->get();
        foreach($allPermissions as $key=> $permissionInfo)
        {
            if($selectedRoleInfo->hasPermissionTo($permissionInfo->name))
            {
                $this->selectedPermissions[] = $permissionInfo->id;
            }
        }
    }
    public function updatePermission()
    {
    	if(!empty($this->selected_role))
    	{
    		$role = Role::find($this->selected_role); 
	        $role->syncPermissions($this->selectedPermissions);
    	} 
    	$this->back();
    }
}
