<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    function upl(Request  $req){
        $dest = '';                 //da do hlavneho priecinka storage

        $name=$req->file('file') ->getClientOriginalName() ;

        $req->file('file') ->storeAs($dest, $name) ;

        return redirect()->route('evaluation');
    }

    public function index()
    {
        return view('evaluation');
    }
}
