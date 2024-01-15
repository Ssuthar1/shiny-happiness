<?php
namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\TemporaryUser; 
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Exception, Validator,DB;
use App\Traits\VerifyTokenStatus;
use JWTAuth;

class UserController extends Controller
{
    use VerifyTokenStatus;

    public function __construct()
    {
        $this->apiArray = array();
        $this->apiArray['error'] = true;
        $this->apiArray['message'] = '';
        $this->apiArray['errorCode'] = 1; 
    }

    public function login(Request $request)
    {        
         try{
            $this->apiArray['state'] = 'login';
            $headers = getallheaders();
            /*Check header */
            if (!$this->verifyTokens($headers['Authkey'],'')){
                $this->apiArray['errorCode'] = 1;
                $this->apiArray['message'] = 'Unauthorized access';
                $this->apiArray['error'] = true;
                $this->apiArray['data'] = null;
                return response()->json($this->apiArray, 200);
            }
            /*End*/

            $inputs = $request->all();            
            $validator = Validator::make($inputs, [
                'mobile_no' => 'required'
            ]);
            if($validator->fails()){
               $this->apiArray['message'] = $validator->messages()->first();
                $this->apiArray['errorCode'] = 3;
                $this->apiArray['error'] = true;
                return response()->json($this->apiArray, 200);
            }

            $globalotp = random_int(100000, 999999);
            $user = User::where('mobile_no',$request->mobile_no)->first();
            if(!empty($user)){
                if($user->status == 0)
                {
                    $this->apiArray['message'] = 'Your account has been deactivated. please contact our support staff to resolve issue.';
                    $this->apiArray['errorCode'] = 1;
                    $this->apiArray['error'] = true;
                    $this->apiArray['data'] = NULL;
                    return response()->json($this->apiArray, 200);  
                }
                $user->update(['mobile_otp'=>$globalotp]);
                $data['mobile_no']  = $inputs['mobile_no'];
                $data['mobile_otp'] = $globalotp;

                $this->apiArray['message'] = 'Please verify OTP. OTP '.$globalotp;
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = false; 
                $this->apiArray['data'] = $data;  
                return response()->json($this->apiArray, 200);
            }else{
                $user               = new User();
                $user['mobile_no']  = $inputs['mobile_no'];
                $user['mobile_otp'] = $globalotp;
                $user['status']     = 1;  
                $user->save();
                $user->assignRole('Customer');
                $data['mobile_no']  = $inputs['mobile_no'];
                $data['mobile_otp'] = $globalotp;
                $this->apiArray['message'] = 'Please verify OTP. OTP '.$globalotp;
                $this->apiArray['errorCode'] = 0;
                $this->apiArray['error'] = false; 
                $this->apiArray['data'] = $data;  
                return response()->json($this->apiArray, 200);
            }
        }catch (\Exception $e){
            $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 500);
        }
    } 

    public function verifyOtp(Request $request)
    {
        try{

            $this->apiArray['state'] = 'verifyOtp';
            $headers = getallheaders();

            /*Check header */
            if (!$this->verifyTokens($headers['Authkey'],'')){
                $this->apiArray['errorCode'] = 1;
                $this->apiArray['message'] = 'Unauthorized access';
                $this->apiArray['error'] = true;
                $this->apiArray['data'] = null;
                return response()->json($this->apiArray, 200);
            }
            /*End*/

            $inputs = $request->all();            
            $validator = Validator::make($inputs, [
                'mobile_no' =>  'required|exists:users,mobile_no',
                'user_otp'  =>  'required', 
                'device_name'  =>  'required', 
            ]);
            if($validator->fails()){
                $this->apiArray['message'] = $validator->messages()->first();
                $this->apiArray['errorCode'] = 3;
                $this->apiArray['error'] = true;
                return response()->json($this->apiArray, 200);
            }

              $user =  User::where('mobile_no',$inputs['mobile_no'])->first();
              if($inputs['user_otp'] == $user->mobile_otp)
              {
                    $token = $user->createToken($inputs['device_name']);
                    if(!empty($user->name) && !empty($user->email)){
                        $data['name']       = $user->name ?? '';
                        $data['email']      = $user->email ?? '';
                        $data['password']   = $user->password ?? '';
                        $data['mobile_no']  = $user->mobile_no;
                        $data['token']      = $token->plainTextToken;
                        $this->apiArray['message'] = 'Otp verify successfully.';
                        $this->apiArray['errorCode'] = 0;
                        $this->apiArray['profile_send'] = false;
                        $this->apiArray['error'] = false; 
                        $this->apiArray['data'] = $data;  
                        return response()->json($this->apiArray, 200);
                    }else{
                        $data['mobile_no']  = $user->mobile_no;
                        $data['token']      = $token->plainTextToken;
                        $this->apiArray['message'] = 'Otp verify successfully.';
                        $this->apiArray['errorCode'] = 0;
                        $this->apiArray['profile_send'] = true;
                        $this->apiArray['error'] = false; 
                        $this->apiArray['data'] = $data;  
                        return response()->json($this->apiArray, 200);
                    }
              }else{
                $this->apiArray['message'] = 'Please enter correct otp.';
                $this->apiArray['errorCode'] = 3;
                $this->apiArray['error'] = true;
                $this->apiArray['data'] = null;
                return response()->json($this->apiArray, 200);
              }

        }catch (\Exception $e){
            $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 500);
        }
    }

    public function getProfile(Request $request)
    {
        try{
            $this->apiArray['state'] = 'getProfile';
            $headers = getallheaders();

            /*Check header */
                $userinfo = $request->user();
                if (!$this->verifyTokens($headers['Authkey'],$userinfo->id)){
                    $this->apiArray['errorCode'] = 2;
                    $this->apiArray['message'] = 'Unauthorized access';
                    $this->apiArray['error'] = true;
                    $this->apiArray['data'] = null;
                    return response()->json($this->apiArray, 200);
                }
            /*End*/
            $user = Auth::guard('api')->user();
            $data = [
                'name'          => $user->name ?? '',
                'email'         => $user->email ?? '',
                'mobile_no'     => $user->mobile_no,
            ];
            
            $this->apiArray['message'] = 'Profile fatch successfully.';
            $this->apiArray['errorCode'] = 0;
            $this->apiArray['error'] = false; 
            $this->apiArray['data'] = $data;  
            return response()->json($this->apiArray, 200);

            //// Function code end here

        }catch (\Exception $e){
            $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 500);
        }
    }
    public function updateProfile(Request $request)
    {
        try{
            $this->apiArray['state'] = 'updateProfile';
            $headers = getallheaders();

            /*Check header */
                $userinfo = $request->user();
                if (!$this->verifyTokens($headers['Authkey'],$userinfo->id)){
                    $this->apiArray['errorCode'] = 2;
                    $this->apiArray['message'] = 'Unauthorized access';
                    $this->apiArray['error'] = true;
                    $this->apiArray['data'] = null;
                    return response()->json($this->apiArray, 200);
                }
            /*End*/
            $inputs = $request->all();            
            $validator = Validator::make($inputs, [
                'name'      => 'required', 
                'email'     => 'required|email|unique:users,email,'.$userinfo->id.',id,deleted_at,NULL', 
                'password'  => 'required', 
            ]);
            if($validator->fails()){
               $this->apiArray['message'] = $validator->messages()->first();
                $this->apiArray['errorCode'] = 3;
                $this->apiArray['error'] = true;
                return response()->json($this->apiArray, 200);
            }

            User::where('id',$userinfo->id)->update([
                'name'      => $inputs['name'],
                'email'     => $inputs['email'],
                'password'  => bcrypt($inputs['password']),
            ]);
            $data = [
                'name'      => $inputs['name'],
                'email'     => $inputs['email'],
            ];
            $this->apiArray['message'] = 'Profile updated successfully.';
            $this->apiArray['errorCode'] = 0;
            $this->apiArray['error'] = false; 
            $this->apiArray['data'] = $data;  
            return response()->json($this->apiArray, 200);

            //// Function code end here

        }catch (\Exception $e){
            $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 500);
        }
    }

    public function register(Request $request)
    {
         try{
            $this->apiArray['state'] = 'register';
            $headers = getallheaders();

            /*Check header */
            if (!$this->verifyTokens($headers['Authkey'],'')){
                $this->apiArray['errorCode'] = 1;
                $this->apiArray['message'] = 'Unauthorized access';
                $this->apiArray['error'] = true;
                $this->apiArray['data'] = null;
                return response()->json($this->apiArray, 200);
            }
            /*End*/

            $inputs = $request->all();            
            $validator = Validator::make($inputs, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
                'mobile_no' => 'required|digits:10|unique:users,mobile_no,NULL,id,deleted_at,NULL',
                'password' => 'required',
            ]);
            if($validator->fails()){
                $this->apiArray['message'] = $validator->messages()->first();
               // $this->apiArray['message'] = 'Please send required fields';
                $this->apiArray['errorCode'] = 3;
                $this->apiArray['error'] = true;
                return response()->json($this->apiArray, 200);
            }
            
            $globalotp = random_int(100000, 999999);

            $userInfo = array();
            $userInfo['name'] = $inputs['name'];
            $userInfo['email'] = $inputs['email'];
            $userInfo['mobile_no'] = $inputs['mobile_no'];
            $userInfo['mobile_otp'] = $globalotp;
            $userInfo['password'] = bcrypt($inputs['password']);

            $user = TemporaryUser::create($userInfo); 
            if ($user) {
                $data['name'] = $inputs['name'];
                $data['email'] = $inputs['email'];
                $data['mobile_no'] = $inputs['mobile_no'];
                $data['password'] = $inputs['password'];
                $this->apiArray['message'] = 'Registered successfully. OTP '.$globalotp;
                    $this->apiArray['errorCode'] = 0;
                    $this->apiArray['error'] = false; 
                    $this->apiArray['data'] = $data;  
                    return response()->json($this->apiArray, 200);
                }else
                {
                    $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
                    $this->apiArray['errorCode'] = 3;
                    $this->apiArray['error'] = true;
                    $this->apiArray['data'] = null;
                    return response()->json($this->apiArray, 200);
                }           
        }catch (\Exception $e){
            $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 500);
        }
    }
    
    public function sampleFunction(Request $request)
    {
        try{

            $this->apiArray['state'] = 'submitOtp';
            $headers = getallheaders();

            /*Check header */
                $userinfo = $request->user();
                if (!$this->verifyTokens($headers['Authkey'],$userinfo->id)){
                    $this->apiArray['errorCode'] = 2;
                    $this->apiArray['message'] = 'Unauthorized access';
                    $this->apiArray['error'] = true;
                    $this->apiArray['data'] = null;
                    return response()->json($this->apiArray, 200);
                }
            /*End*/

            $inputs = $request->all();            
            $validator = Validator::make($inputs, [
                'user_id' => 'required',
                'user_otp' => 'required', 
            ]);
            if($validator->fails()){
               $this->apiArray['message'] = $validator->messages()->first();
                $this->apiArray['errorCode'] = 3;
                $this->apiArray['error'] = true;
                return response()->json($this->apiArray, 200);
            }

            //// Function code start here

            //// Function code end here

        }catch (\Exception $e){
            $this->apiArray['message'] = 'Something is wrong, please try after some time'.$e->getMessage();
            $this->apiArray['errorCode'] = 2;
            $this->apiArray['error'] = true;
            $this->apiArray['data'] = null;
            return response()->json($this->apiArray, 500);
        }
    }

    
}
