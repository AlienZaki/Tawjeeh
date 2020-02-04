<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;

class QRcodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generateQRcode($id)
    {   $by = Auth::user()->email;
        $code = 'Tawjeeh_'.$by.'_'.$id;
        $QRCode = QrCode::size(300)->generate($code);
        return $QRCode;
    }

    public function printQRcode()
    {
        return view('qrcode')->with('id', 'Tawjeeh258');
    }
}
