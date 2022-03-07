<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Skusky;
use App\Models\Zadania;
use App\Models\Ulohy;
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

        $persons = Zadania::all()->where('skusky_id','=',$skuska);

        return view('skuska')->with(compact('lastName','persons'));

    }

    public function storeSk($skuska) {         //vytvorenie zadania v user/skuska/{skuska}

        $user = Skusky::find(1);
        $user->zadania()->create(request()->validate([
            "nazov" => "required|string|min:3"

        ]));



        return back();
    }

    public function showZ($skuska,$zadanie)   //zobrazenie uloh v user/skuska/{skuska}/(zadania)
    {

        $ms = Skusky::all();
        $lastName = $zadanie;
        $skuska = $skuska;

        $persons = Ulohy::all()->where('zadania_id','=',$lastName);

        return view('ulohy')->with(compact('lastName','persons','skuska'));

    }

    public function storeU($skuska) {         //vytvorenie zadania v user/skuska/{skuska}/(zadania)

        $user = Skusky::find(1);
        $user->zadania()->create(request()->validate([
            "nazov" => "required|string|min:3"

        ]));



        return back();
    }

}
