<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Riesenia;
use App\Models\Skusky;
use App\Models\Zadania;
use App\Models\Ulohy;
use App\MOdels\Studenti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class SkuskyController extends Controller
{

    public $student=0;

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
        $id=$skuska->zadania()->create(request()->validate([
            "nazov" => "required|string|min:3"

        ]))->id;


        $token = Str::random(10) ;

        $zadanie=Zadania::find($id);
        $zadanie->update([

            'token' => ($token)
        ]);



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

        $dest = '/storage/app/storage/vzorove';
      //  $txt = request()->file('obrazok');
        $nazov = $request->file('obrazok')->getClientOriginalName();
        $ste=$request->file('obrazok')->storeAs($dest,$nazov);


        //$ste->save($dest . $nazov);

        // aktualizacia cesty pre obrazok a token

        $token = Str::random(10) ;

        $uloha=Ulohy::find($id);
        $uloha->update([
           'obrazok' => ('/app/storage/vzorove/' . $nazov),
            'token' => ($token)
        ]);


        return back();
        //return redirect($nazov);
    }

    public function showU(Request $request){


        $uloha=$request->uloha;



        $post=Ulohy::find($uloha);

        $content = $post->obrazok;





        return view('uloha')->with(compact('post','content'));




    }

    public function storeU(Request $request){

        /*
        $idd= $request->skuska;

        $skuska = Skusky::find($idd);
        $skuska->zadania()->create(request()->validate([
            "nazov" => "required|string|min:3"

        ]));

        */




        $sundays = $request->box;
        $pole = array();



        $i=0;
        $size= $request->size;

        while($i<$size) {

            if (isset($sundays[$i])) {

                $pole[] = 1;
                //dd('je 1');

            } else {
                //dd('nenastavene');
                $pole[] = 0;

            }
            $i++;

        }

        $dbRiadiace=serialize($pole);
       // dd(unserialize($dbRiadiace));


        $uloha=Ulohy::find($request->uloha);
        $uloha->update([
            'riadiace' => ($dbRiadiace)
        ]);




            return back();
    }


    public function showIn(){


        return view('inputSkuska');

    }

    public function storeIn(Request $request){


        $student = Studenti::where('ldap', '=', $request->ldap)->first();
        if($student == null){
           // dd('student este neexistuje');

            Studenti::create(request()->validate([

                "meno" => "required|string|min:3",
                "priezvisko" => "required|string|min:3",
                "ldap" => "required|string|min:3"
            ]));
        }

        $student = Studenti::where('ldap', '=', $request->ldap)->first()->id;




        $zadanie = Zadania::where('token','=', $request->token)->first()->id;



       $ulohy = Ulohy::where('zadania_id','=',$zadanie)->get();

        redirect('eeeeeeeee');

        $request->session()->put('ulohy',$ulohy);
        $request->session()->put('student',$student);


        return redirect('/skuska/start');





    }


    public function showEx(Request $request){

        $ulohy=$request->session()->get('ulohy');
        $student=$request->session()->get('student');

        return view('exam', compact('ulohy', 'student'));

    }


    public function storeEx(Request $request){


        $obrazok = $request->obrazok;



        $dest = '/storage/app/storage/riesenia';
        //  $txt = request()->file('obrazok');



        $i=0;
        foreach ($obrazok as $obr){

            $riesenie = new Riesenia();

            $riesenie->ulohy_id=$request->uloha[$i];

            $riesenie->studenti_id=$request->student;

            //ulozenie konfiguracie
            $nazov = $obr->getClientOriginalName();
            $ste=$obr->storeAs($dest,$nazov);
            $riesenie->konfiguracia=$nazov;


            $i++;

            $riesenie->save();

        }






    }




}

