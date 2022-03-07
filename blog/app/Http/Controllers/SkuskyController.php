<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Skusky;
use App\Models\Zadania;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SkuskyController extends Controller
{
    public function index()     //vypis skusok v user/skuska
    {

        $prispevky = Skusky::all();

        return view('skusky',compact('prispevky'));

    }

    public function store() {       //vytvorenie novejskusky v user/skuska
        $user = Auth::user();
        $post = $user->skusky()->create(request()->validate([

            "nazov" => "required|string|min:3"
        ]));
        return redirect('/user/skuska');
    }

    public function show($skuska)   //zobrazenie zadani v user/skuska/{skuska}
    {

        //$prispevky = Skusky::all();
       // $zadania = Zadania::all();

       // return view('skuska',compact('prispevky'),compact('zadania'));


        $ms = Skusky::all();
        $lastName = $skuska;

        $persons = Zadania::all();

        return view('skuska')->with(compact('lastName','persons'));

    }

    public function storeSk($skuska) {         //vytvorenie zadania v user/skuska/{skuska}

        $user = Skusky::find(1);
        $user->zadania()->create(request()->validate([
            "nazov" => "required|string|min:3"

        ]));



        return redirect('/user/skuska/{skuska}');
    }
}
