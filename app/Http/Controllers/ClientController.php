<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Client;

class ClientController extends Controller
{
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
}
