<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Skusky;
use App\Models\Zadania;
use App\Models\Ulohy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


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

    public function storeSk(Request $request) {         //vytvorenie zadania v user/skuska/{skuska}

        $idd= $request->skuska;
        $skuska = Skusky::find($idd);
        $skuska->zadania()->create(request()->validate([
            "nazov" => "required|string|min:3"

        ]));



       // return back();
        return back();
    }

    public function showZ(Request $request, $skuska, $zadanie)   //zobrazenie uloh v user/skuska/{skuska}/{zadanie}  skuska je id zadanie neviem preco
    {

        //$ms = Skusky::all();
        $lastName = $zadanie;
       $url=$request->fullUrl();


        $persons = Ulohy::all()->where('zadania_id','=',$lastName);


        return view('ulohy')->with(compact('lastName','persons','url'));


    }

    public function storeZ(Request $request) {         //vytvorenie ulohy v user/skuska/{skuska}/{zadanie}

        $id = $request->zadanie;

        $zadanie = Zadania::find($id);
        $id=$zadanie->ulohy()->create(request()->validate([
            "nazov" => "required|string|min:3"

        ]))->id;


        //dd($request->all());

        $dest = '/storage/vzorove/';
      //  $txt = request()->file('obrazok');
        $nazov = $request->file('obrazok')->getClientOriginalName();
        $ste=$request->file('obrazok')->storeAs($dest,$nazov);


        //$ste->save($dest . $nazov);

        // aktualizacia cesty pre obrazok
        $uloha=Ulohy::find($id);
        $uloha->update([
           'obrazok' => ('postImages/' . $nazov)
        ]);


        return back();
        //return redirect($nazov);
    }




}
