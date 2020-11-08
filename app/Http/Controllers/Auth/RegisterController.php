<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Socialite;
use App\SocialProvider;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifikasiReg;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {

        $url = 'http://'.$_SERVER['HTTP_HOST'];
        $name = $request->name;
        $combain = $request->name.'&'.$request->email;
        $key = preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(24)));

        $admin = DB::table('admins')->select('id','email','name')->where('email',$request->email)->first();
       
        if(empty($admin))
        {

        Mail::to($request->email)->send(new VerifikasiReg($url,$key,$name));

        $user = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'active' => 'N',
            'created_at'=> new \DateTime(),
            
        ]);
        DB::table('email_confirmations')->insert(['user_id'=>$user->id,'code'=>$key,'created_at'=> new \DateTime(),'confirmed'=>'N']);

         $title = config('app.name');
          $name = "Register Berhasil";

          $status['active'] = 'NV';
          $object = (object)$status;
           
          return view('_patrial.verifikasi')->with(['status'=> $object,'title'=>$title,'name'=>$name,'url'=>$url]);

      }else{
        
          $title = config('app.name');
          $name = "Register Gagal";

          $status['active'] = 'DUE';
          $object = (object)$status;

          return view('_patrial.verifikasi')->with(['status'=> $object,'title'=>$title,'name'=>$name,'url'=>$url]); 

      }

      
     

    }

     public function redirectToProvider($provider)
    {

        return socialite::driver($provider)->redirect();
    }


    public function handleProviderCallback($provider)
    {
        
        try
        {
            $socialUser = Socialite::driver($provider)->user();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
        //check if we have logged provider
        $socialProvider = SocialProvider::where('provider_id',$socialUser->getId())->first();
        if(!$socialProvider)
        {
            //create a new user and provider
  
           $user =  User::create([
            'name' => $socialUser->getName(),
            'email' => $socialUser->getEmail(),
            'active' => 'N',
            'created_at'=> new \DateTime()

        ]);
 
            $user->socialProviders()->create(
                ['provider_id' => $socialUser->getId(), 'provider' => $provider]
            );
 
        }
        else
                $user = $socialProvider->user;
 
                auth()->login($user);

                $cekPass = DB::table('admins')->where('id',$user->id)->get();
                if(empty($cekPass[0]->password))
                {
                  return redirect('/member');
                }    
                  

                return redirect('/home');
 
    }
}
