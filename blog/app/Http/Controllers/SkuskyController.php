<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Skusky;
use Illuminate\Http\Request;

class SkuskyController extends Controller
{
    public function index()
    {

        $prispevky = Skusky::all();
        return view('skusky',compact('prispevky'));

    }
}
