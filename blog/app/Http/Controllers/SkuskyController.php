<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Skusky;
use App\Models\Zadania;
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

    public function show()
    {

        //$prispevky = Skusky::all();
       // $zadania = Zadania::all();

       // return view('skuska',compact('prispevky'),compact('zadania'));


        $ms = Skusky::all();

        $persons = Zadania::all();

        return view('skuska')->with('persons', $persons)->with('ms', $ms);

    }

    public function storeSk() {
        Zadania::create(request()->validate([
            "nazov" => "required|string|min:3",
            'skuska_id' => 'required|numeric'
        ]));
        return redirect('/user/skuska/{skuska}');
    }
}
