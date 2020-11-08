<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\Models\User;
use JWTAuthException;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MemberRepository;
use App\Http\Requests\CreateMemberRequest;
use App\Http\Requests\UpdateMemberRequest;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Helpers\GeneralHelpers;

class MemberController extends Controller
{   
    private $memberRepository;
    public function __construct(MemberRepository $memberRepo)
    {
        $this->memberRepository = $memberRepo;
        $this->Cfg = config();
        $this->perPage = $this->Cfg['general']['limitData'];
        
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password', 'username');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function active($id='', $active='N')
    {
        
        $dataPost['status'] = $active;
        $__temp_ = $this->memberRepository->update($dataPost, $id);
        
        $results['data'] = $__temp_;
        return response()->json($results);
    }

    public function lists(Request $request)
    {
        $type ='member';
        $this->memberRepository->pushCriteria(new RequestCriteria($request));
        $_tempResult = $this->memberRepository->getWithLimit($this->perPage,$type);
        $results = $this->__build($_tempResult, $request);
        return response()->json($results);
    }

    public function search(Request $request)
    {
        
        $this->memberRepository->pushCriteria(new RequestCriteria($request));
        $_tempResult = $this->memberRepository->getSearch($request->all(), $this->perPage);
        $results = $this->__build($_tempResult, $request);
        return response()->json($results);
    }
   

    function __build($data, $request){

        $__temp_ = array();

        $getRequest = $request->all();
        
        $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
        $numberNext = (($page*$this->perPage) - ($this->perPage-1));

        foreach ($data as $key => $val) {
            $__temp_[$key]['number'] = $numberNext++;
            $__temp_[$key]['id'] = $val['id'];
            $__temp_[$key]['username'] = $val['username'];
            $__temp_[$key]['fullname'] = $val['fullname'];
            $__temp_[$key]['email'] = $val['email'];
            $__temp_[$key]['phone'] = $val['phone'];
            $__temp_[$key]['facebook'] = $val['facebook'];
            $__temp_[$key]['instagram'] = $val['instagram'];
          

            
            $__temp_[$key]['status'] = $val['status'];
            $__temp_[$key]['photo'] = !empty($val['photo']) ? $this->Cfg['app']['mediaUrl'].'/users/'.$val['photo'] : $this->Cfg['app']['mediaUrl'].'/users/default-user.png';
          

            $created_at = (string) $val['created_at'];
            $__temp_[$key]['created_at'] = GeneralHelpers::tanggal_indo($created_at);
        }

        $results['data'] = $__temp_;
        $results['total'] = $data->total();
        $results['lastPage'] = $data->lastPage();
        $results['perPage'] = $data->perPage();
        $results['currentPage'] = $data->currentPage();
        $results['nextPageUrl'] = $data->nextPageUrl();

        return $results;

    }

    public function post(CreateMemberRequest $request)
    {

        $fields = [
            'office_name'     => 'Office Name',
            'email'     => 'Email',
            'username'  => 'Username',
            'fullname'  => 'Fullname',
            'address'  => 'Address',
            'domain'  => 'Domain',
            'packet'  => 'packet',
            'date_start'  => 'Date Start',
            'date_end'  => 'Date End',
            'password'  => 'Password',
            'password_confirmation'  => 'Password Confirmation',
            'username'  => 'Username',

        ];

        $validator =  Validator::make($request->all(), [
            'office_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:8|min:4|unique:users',
            'fullname' => 'required|max:255',
            'address' => 'required|max:255',
            'domain' => 'required|max:255',
            'packet' => 'required|max:255',
            'date_start' => 'required|max:255',
            'date_end' => 'required|max:255',
            'password' => 'required|max:8|min:4|confirmed',
            'password_confirmation' => 'required|max:8|min:4|same:password',
        ]);
        
        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
            
            $errors = $validator->errors();
            
            if($errors->has('email')){
                $err['messages']['email'] = $errors->first('email');
            }

              if($errors->has('office_name')){
                $err['messages']['office_name'] = $errors->first('office_name');
            }

            if($errors->has('username')){
                $err['messages']['username'] = $errors->first('username');
            }

             if($errors->has('fullname')){
                $err['messages']['fullname'] = $errors->first('fullname');
            }

            if($errors->has('address')){
                $err['messages']['address'] = $errors->first('address');
            }

            if($errors->has('domain')){
                $err['messages']['domain'] = $errors->first('domain');
            }

            if($errors->has('packet')){
                $err['messages']['packet'] = $errors->first('packet');
            }

             if($errors->has('date_start')){
                $err['messages']['date_start'] = $errors->first('date_start');
            }

             if($errors->has('date_end')){
                $err['messages']['date_end'] = $errors->first('date_end');
            }

            if($errors->has('password')){
                $err['messages']['password'] = $errors->first('password');
            }

            if($errors->has('password_confirmation')){
                $err['messages']['password_confirmation'] = $errors->first('password_confirmation');
            }
            
            return response()->json($err);

        }

        $data = [
            'office_name' => $request['office_name'],
            'email' => $request['email'],
            'username' => trim($request['username']),
            'fullname' => $request['fullname'],
            'address' => $request['address'],
            'domain' => $request['domain'],
            'packet' => $request['packet'],
            'date_start' => $request['date_start'],
            'date_end' => $request['date_end'], 
            'type' => 'member',
            'password' => Hash::make(trim($request['password'])),
            'status' => ($request['status'] == 1) ? 'Y' : 'N',
        ];  

        // return response()->json(['id'=>1]);
        $save = $this->memberRepository->create($data);
        if($save->id){
            return response()->json(['id'=>$save->id]);
        }   

    }

    public function edit($id)
    {
        $checked = "";
        $results = array();
        $user = $this->memberRepository->findWithoutFail($id);
        if(empty($user)){
            return response()->json(['messages' => false]);
        }

        $results['id'] = $user->id;
        $results['username'] = $user['username'];
        $results['fullname'] = $user['fullname'];
        $results['email'] = $user['email'];
        $results['office_name'] = $user['office_name'];
        $results['address'] = $user['address'];
        $results['packet'] = $user['packet'];
        $results['domain'] = $user['domain'];
        $results['date_start'] = $user['date_start'];
        $results['date_end'] = $user['date_end'];
        $results['status'] = $user['status'];
       
        return response()->json($results);

    }

    public function update($id, UpdateMemberRequest $request){
        
        $err = array();
        $fields = [
            'office_name'     => 'Office Name',
            'email'     => 'Email',
            'username'  => 'Username',
            'fullname'  => 'Fullname',
            'address'  => 'Address',
            'domain'  => 'Domain',
            'packet'  => 'packet',
            'date_start'  => 'Date Start',
            'date_end'  => 'Date End',
            'password'  => 'Password',
            'password_confirmation'  => 'Password Confirmation',
            'username'  => 'Username',

        ];

      $validator =  Validator::make($request->all(), [
            'office_name' =>'required|max:255',
            'email' => 'required|email|max:255',
            'fullname' => 'required|max:255',
            'username' => 'required|max:8|min:4',
            'address' =>'required|max:255',
            'domain'  => 'required|max:255',
            'packet'  => 'required|max:255',
            'date_start'  => 'required|max:255',
            'date_end'  => 'required|max:255',
            'password' => 'nullable|max:8|min:4|confirmed',
            'password_confirmation' => 'nullable|max:8|min:4|same:password',
        ]);
        
        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
            
            $errors = $validator->errors();
            
            if($errors->has('email')  && !empty($request->has('email'))){
                $err['messages']['email'] = $errors->first('email');
            }

              if($errors->has('office_name')){
                $err['messages']['office_name'] = $errors->first('office_name');
            }

            if($errors->has('username')  && !empty($request->has('username'))){
                $err['messages']['username'] = $errors->first('username');
            }

             if($errors->has('fullname')){
                $err['messages']['fullname'] = $errors->first('fullname');
            }

            if($errors->has('address')){
                $err['messages']['address'] = $errors->first('address');
            }

            if($errors->has('domain')){
                $err['messages']['domain'] = $errors->first('domain');
            }

            if($errors->has('packet')){
                $err['messages']['packet'] = $errors->first('packet');
            }

             if($errors->has('date_start')){
                $err['messages']['date_start'] = $errors->first('date_start');
            }

             if($errors->has('date_end')){
                $err['messages']['date_end'] = $errors->first('date_end');
            }

            if($errors->has('password') && !empty($request->has('password')) ){
                $err['messages']['password'] = $errors->first('password');
            }

            if($errors->has('password_confirmation') && !empty($request->has('password_confirmation')) ){
                $err['messages']['password_confirmation'] = $errors->first('password_confirmation');
            }
            
            return response()->json($err);

        }

       
        $pass = array();
        if($request->has('password') && !empty($request->has('password'))){
            $pass = ['password' => Hash::make(trim($request['password']))];
        }

        

        $data = [
            'office_name' => $request['office_name'],
            'email' => $request['email'],
            'fullname' => $request['fullname'],
            'username' => trim($request['username']),
            'address' => $request['address'],
            'domain' => $request['domain'],
            'packet' => $request['packet'],
            'date_start' => $request['date_start'],
            'date_end' => $request['date_end'], 
            'type' => 'member',
            'status' => ($request['status'] == 1) ? 'Y' : 'N',
        ];  

        $data = array_merge($pass,$data);

        $save = $this->memberRepository->update($data, $id);
        if($save->id){
            return response()->json(['id'=>$save->id]);
        }   


    }

    public function delete($id)
    {
        $messages['messages'] = false;
        $user = $this->memberRepository->findWithoutFail($id);
        if(empty($user)){
            return response()->json(['messages' => false]);
        }

        $results = $this->memberRepository->delete($id);
        if($results){
            $messages['messages'] = true;
        }
        return response()->json($messages);
    }


    
}  