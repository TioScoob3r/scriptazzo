<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\Settings;
use App\Models\Audit;
use Carbon\Carbon;
use Session;
use Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:user');
    }

    public function login()
    {
        $data['lang'] = parent::getExternalVars("login_layout_pages");
	    $data['title']='Login';
        return view('/auth/login', $data);
    } 
    
    public function submitlogin(Request $request)
    {
        $data['lang'] = parent::getExternalVars("login_layout_pages");
        $set=$data['set']=Settings::first();
        if($set->recaptcha==1){
            $validator = Validator::make($request->all(), [
                'email' => 'required|string',
                'password' => 'required',
                'g-recaptcha-response' => 'required|captcha'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'email' => 'required|string',
                'password' => 'required'
            ]);
        }
        if ($validator->fails()) {
            // adding an extra field 'error'...
            $data['title']='Login';
            
            $data['errors']=$validator->errors();
            return view('/auth/login', $data);
        }
        $remember_me = $request->has('remember_me') ? true : false; 
        if (Auth::guard('user')->attempt([
            'email' => $request->email, 
            'password' => $request->password
            ], $remember_me)) {
        	$ip_address=user_ip();
        	$user=User::whereid(Auth::guard('user')->user()->id)->first();
        	if($ip_address!=$user->ip_address && $set['email_notify']==1){
    			send_email($user->email, $user->username, 'Suspicious Login Attempt', 'Sorry your account was just accessed from an unknown IP address<br> ' .$ip_address. '<br>If this was you, please you can ignore this message or reset your account password.');
        	}
	        $user->last_login=Carbon::now();
	        $user->ip_address=$ip_address;
            $user->save();
            if($user->fa_status==1){
                return redirect()->route('2fa');
            }else{
                if(Session::has('oldLink')){
                    return Redirect::to(Session::get('oldLink'));
                }else{
                    return redirect()->route('user.dashboard');
                }

            }
            
        } else {
        	return back()->with('alert', 'Oops! You have entered invalid credentials')->withInput($request->only('email', 'remember'));
        }

    }

}
