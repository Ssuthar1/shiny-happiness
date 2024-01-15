<?php
namespace App\Traits;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait VerifyTokenStatus
{

	public function __construct()
    {
        $this->apiArray = array();
        $this->apiArray['error'] = true;
        $this->apiArray['message'] = '';
        $this->apiArray['errorCode'] = 1;
    }

	public function verifyTokens($token,$id='')
	{
		if($token!=''){
			if($token=='Fresh*&Fruit&*s524KJH'){
				if($id!=''){
					$user = User::where('id',$id)->where('status',1)->first();
					if ($user) {
						// code...
						return true;
					}else{
						$this->apiArray["message"] = "user inactive";
					}	
				}else{
					return true;
				}
			}else{
				$this->apiArray["message"] = "authkey mismatch";
			}
		}else{
            $this->apiArray["message"] = "authkey absent";
		}
	}

}
