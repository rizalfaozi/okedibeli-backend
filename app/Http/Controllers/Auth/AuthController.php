<?php

namespace App\Http\Controllers\Auth;
use InfyOm\Generator\Utils\ResponseUtil;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\VerifikasiReg;
use App\Mail\ForgotPass;

class AuthController extends AppBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {

        

    }


     public function dokumentasi()
    {

      
       return view('auth.dokumentasi');

    }



    public function verifikasi(Request $request)
    {
      $url = env('APP_URL', '');
      $title = config('app.name');
      $name = "Verifikasi Akun";
      $status['active'] = 'NV';
      $object = (object) $status;

      return view('_patrial.verifikasi')->with(['status'=> $object,'url'=>$url,'title'=>$title,'name'=>$name]);
      
    }  

    public function active(Request $request)
    {
        $title = config('app.name');
        $name = "Verifikasi Akun";

        $akun = $request->akun;
       
    
        $emailConfirmation =  DB::table('email_confirmations')->where('code', 'like', ''.$akun.'%')->first();
        if(empty($emailConfirmation))
        {

          //return abort(404);
          $status['active'] = 'IV';
          $object = (object) $status;
          return view('_patrial.verifikasi')->with(['status'=> $object,'title'=>$title,'name'=>$name]);
        }else{

          DB::table('admins')->update(['active'=>'Y']);
           DB::table('email_confirmations')->update(['confirmed'=>'Y','updated_at'=> new \DateTime()]);
          $status = DB::table('admins')->select('active')->first();
          return view('_patrial.verifikasi')->with(['status'=> $status,'title'=>$title,'name'=>$name]);
          
          
        }


            

         


    }

    public function lupa(Request $request)
    {

      return view('auth.passwords.email');

    }  

    public function lupakirim(Request $request)
    {
        $email = $request->email;

        $admin = DB::table('admins')->select('id','email','name')->where('email',$email)->first();
        $url = 'http://'.$_SERVER['HTTP_HOST'];
        if(empty($admin))
        {
          $title = config('app.name');
          $name = "Lupa Password";

          $status['active'] = 'EK';
          $object = (object)$status;

          return view('_patrial.verifikasi')->with(['status'=> $object,'title'=>$title,'name'=>$name,'url'=>$url]); 

        }else{

      
        $name = $admin->name;
        $combain = $admin->name.'&'.$admin->email;
        $key = preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(24)));

        Mail::to($request->email)->send(new ForgotPass($url,$key,$name));
      
      $reset = DB::table('reset_passwords')->insert(['user_id'=>$admin->id,'code'=>$key,'reset'=>'N','created_at'=> new \DateTime()]);

          $title = config('app.name');
          $name = "Lupa Password";

          $status['active'] = 'LP';
          $object = (object)$status;

          //echo json_encode($object);
          
          return view('_patrial.verifikasi')->with(['status'=> $object,'title'=>$title,'name'=>$name,'url'=>$url]);
        }
    } 

    public function forgot(Request $request)
    {

       
        $title = config('app.name');
        $name = "Verifikasi Akun";

        $akun = $request->akun;
       
    
        $resetPasswords =  DB::table('reset_passwords')->where('code', 'like', ''.$akun.'%')->first();
        if(empty($resetPasswords))
        {

          //return abort(404);
          $status['active'] = 'IV';
          $object = (object) $status;
          return view('_patrial.verifikasi')->with(['status'=> $object,'title'=>$title,'name'=>$name]);
        }else{

       
           
          $status = DB::table('admins')->where(['id'=>$resetPasswords->user_id])->select('email','name')->first();
          return view('auth.passwords.reset')->with(['status'=> $status,'title'=>$title,'name'=>$name]);
          
          
        }


    }


     public function forgotSend(Request $request)
    {
      $email = $request->email;
      $password = $request->password;
      $confrmpassword = $request->password_confirmation;
     

      if($password == $confrmpassword)
      {


          $user = DB::table('admins')->where(['email'=>$email])->select('id','name')->first();
          DB::table('admins')->where(['email'=>$email])->update(['password'=> bcrypt($password)]);
          DB::table('reset_passwords')->where(['user_id'=>$user->id])->update(['reset'=> 'Y','updated_at'=>new \DateTime()]);

          $loggedIn = \Auth::attempt([
              'email' => $request->email,
              'password' => $password,
          ]);
  
          return redirect('home');

      }else{

          $status['email'] = $request->email;
          $object = (object) $status;  
          return view('auth.passwords.reset')->with(['status'=> $status,'title'=>$title,'name'=>$name]);

      }  

      


    } 
}
