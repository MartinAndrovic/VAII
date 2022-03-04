<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

    public function store() {
        Skusky::create(request()->validate([
            "nazov" => "required|string|min:3"
        ]));
        return redirect('/user/skuska');
    }
}
