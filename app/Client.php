<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'cid', 'phone1', 'phone2' ,'comment', 'qrcode'];
}
