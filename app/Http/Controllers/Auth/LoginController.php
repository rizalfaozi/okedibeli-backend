<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use JWTAuth;
use JWTAuthException;
use DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }
    
    public function password()
    {
        return 'password';
    }

    /**
     * logout function
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout() {
        \Auth::logout();
        \Session::flush();
        return redirect('/');
    }


    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        $field = 'username';
        if ($user == null) {
            return  redirect()->back()
                ->withInput($request->except('password'))
                ->withErrors([$this->username() => trans('auth.member_notfound')]);
        } else {

            $smf_passwd = "";
            if ($field == 'username' && Hash::check($request['password'], $user->password)) {
                $smf_passwd = $user->password;
            } 

            if ($smf_passwd == $user->password) {
                if ($user->status == 0) {
                    return redirect()->back()
                        ->withInput($request->except('password'))
                        ->withErrors([$this->username() => trans('auth.not_active')]);
                } 
            } else {
                return redirect()->back()
                    ->withInput($request->except('password'))
                    ->withErrors([$this->password() => trans('auth.password_failed')]);
            }
        }

        return true;
    }

   
}
