<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Auth;
use App\User;
use Hash;
use Session;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function loginA(Request $request)
    {
        // dd($request->all());
        $credentials = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        );
        
		$remember = ($request->has('remember_me')) ? true : false;
		
        $user = User::where("email", $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                
                if($user->hasRole('superadmin')){
                    if(Auth::attempt($credentials,$remember)){
                        if($remember){
                            setcookie("email", $request->get('email'),0,"/");
                            setcookie("password",  $request->get('password'),0,"/");
                            
                        }else{
                            setcookie("email", "",0,"/");
                            setcookie("password",  "",0,"/");
                        }
                        Session::flash('flash_success', trans('auth.message.success'));
                        return redirect('admin');
                    }
                }else{
                    $message = trans('auth.message.notaccess');
                }
            } else {
                $message = trans('auth.message.invalid_username_or_password');
            }
        } else {
            $message =trans('auth.message.invalid_username_or_password');;
        }
        Session::flash('flash_error', $message);
        return redirect()->back()->withInput();
    }
}
