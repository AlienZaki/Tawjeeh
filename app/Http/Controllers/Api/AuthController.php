<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
class AuthController extends Controller
{
    public $successStatus = 200;

    public function register(Request $request) {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'c_password' => 'required|same:password',
                'type' => 'required',

            ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);                        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('AppName')->accessToken;
        return response()->json(['success'=>'true','data'=>$success], 200);
    }


    public function login(Request $request){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $host = $request->getHttpHost();
            $user = Auth::user();
            $res['username'] = $user['email'];
            $res['name'] = $user['name'];
            $res['photo'] = 'http://'.$host.'/photos/'.$user['photo'];
            $res['stage'] = $user['stage'];
            $res['token'] =  'Bearer '.$user->createToken('AppName')-> accessToken;
            return response()->json(['success'=>true,'data' => $res], 200);
        } else{
            return response()->json(['success'=>false,'message'=>'Invalid login'], 401);
        }
    }

    public function getUser() {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
