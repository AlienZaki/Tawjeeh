<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Client;
use Validator;

class ClientController extends Controller
{

    public function signup(Request $request){
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'cid' => 'required|unique:clients',
                'phone1' => 'required',

            ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'errors'=>$validator->errors()], 401);                        }
        $input = $request->all();
        $nextId = Client::orderBy('id', 'desc')->first()['id']+1;
        $user = Auth::user();
        $input['qrcode'] = 'Tawjeeh_'.$user['email'].'_'.$nextId;
        $client = Client::create($input);
        $msg = 'Client has been added!';
        $res['qrcode'] = $client['qrcode'];
        return response()->json(['success'=>true,'message'=>$msg, 'data'=>$res], 200);
    }

    public function getClient($qrCode) {
        $client = Client::where('qrcode', $qrCode)->first();
        if($client){
            $res['cid'] = $client['cid'];
            $res['name'] = $client['name'];
            $res['phone1'] = $client['phone1'];
            $res['phone2'] = $client['phone2'];
            $res['qrcode'] = $client['qrcode'];
            $res['stages']['S1'] = $client['s1'];
            $res['stages']['S2'] = $client['s2'];
            $res['stages']['S3'] = $client['s3'];
            $res['stages']['S4'] = $client['s4'];
            return response()->json(['success' => true, 'data'=> $res], 200);

        }else{ // client not exist.
            return response()->json(['success' => false, 'message'=> 'Not Found'], 301);
        }

    }

    public function flagStage($qrCode) {
        $client = Client::where('qrcode', $qrCode)->first();
        if($client){
            $user = Auth::user();
            $stage = $user->stage;
            $client->$stage= 1;
            $client->save();

            $res['cid'] = $client['cid'];
            $res['name'] = $client['name'];
            $res['stages']['S1'] = $client['s1'];
            $res['stages']['S2'] = $client['s2'];
            $res['stages']['S3'] = $client['s3'];
            $res['stages']['S4'] = $client['s4'];
            return response()->json(['success' => true, 'message'=> 'Stage Confirmed', 'data'=> $res], 200);

        }else{ // client not exist.
            return response()->json(['success' => false, 'message'=> 'Not Found'], 301);
        }

    }
}
