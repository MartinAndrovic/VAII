<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    function upl(Request  $req){

        $name=$req->file('file') ->getClientOriginalName() ;

        $req->file('file') ->storeAs('blog\public\storage', $name) ;

        return redirect()->route('evaluation');
    }

    public function index()
    {
        return view('evaluation');
    }
}
