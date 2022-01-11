<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    function upl(Request  $req){

        $name=$req->file('file') ->getClientOriginalName() ;

        return $req->file('file') ->storeAs('blog\public', $name) ;
    }
}
