<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Account;
use App\Models\Report;
use App\Models\ProviderSchem;
use GuzzleHttp\Client;
use App\Traits\DistributeCommission;
use Config;

trait SendSms
{ 
    public $apiArray,$data;
 	protected $username = 'oogisticotp.trans';
    protected $password = 'TUrm9'; 
    protected $unicode = 'false'; 
    protected $from = 'OGSTIC'; 
    protected $url = "https://omni.myctrlbox.com/fe/api/v1/send";

	public function sendMessage($mobile_no,$sms_type,$otp)
	{  
 	 	$client = new Client(); 
 	 	 
 	 	 if($sms_type=='otp')
 	 	 {
 	 	 	$template_id = '1707168984228092402';
 	 	 	$message = "OOGISTIC EXPORTS: ".$otp." is your OTP to proceed on the Fresh Fruit Express portal. Please don't share your OTP with anyone.";
 	 	 }
 	 	 
 	 	$queryInfo = [
		    'username' => $this->username,
		    'password' => $this->password,
		    'unicode' => $this->unicode,
		    'from' => $this->from,
		    'to' => $mobile_no,
		    'text' => $message,
		    'dltContentId' => $template_id,
		];
       
        /*$response = $client->get($this->url, [
            'query' => $queryInfo,
        ]);*/
        $response = true;
        return $response;
         
	} 
}
