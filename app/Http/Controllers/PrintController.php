<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function prnpriview()
    {
        return view('qrcode')->with('id', 'Tawjeeh258');;
    }
}
