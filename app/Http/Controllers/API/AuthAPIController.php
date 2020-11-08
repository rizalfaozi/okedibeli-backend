<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use JWTAuthException;
use App\MySSOServer;

class AuthAPIController extends Controller
{   
    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }

   public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);

        return response()->json(['status'=>true,'data' => $user,'message'=>'data user']);
    }
   



    
}  