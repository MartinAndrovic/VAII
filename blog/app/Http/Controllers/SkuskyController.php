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

    public function show($skuska)   //zobrazenie zadani v user/skuska/{skuska} a rieseni
    {

        //$prispevky = Skusky::all();
       // $zadania = Zadania::all();

       // return view('skuska',compact('prispevky'),compact('zadania'));


        $ms = Skusky::all();
        $lastName = $skuska;

        $persons = Zadania::all()->where('skusky_id','=',$skuska);



        //zobrazenie studentov

        //$zadanie=Zadania::all()->where('skusky_id', '=', $skuska);
        //$idZadani=Zadania::select('id')->where('skusky_id', '=', $skuska);



        //vysledky-------------------------------------------------------------------------------

        $skuskaAkt=Skusky::where('id','=',$skuska)->first();
       // dd($skuskaAkt);


        $idZadani=$skuskaAkt->zadania()->select('id');        //idcka vsetkych zadani v skuske, aj tych bez uloh
        $zadania= $skuskaAkt->zadania()->get();


        //dd($idZadani);

        $ulohy = Ulohy::whereIn('zadania_id',$idZadani)->select('id');      //idcka vsetkych uloh v skuske
        $idzadaniaSU = Ulohy::whereIn('zadania_id',$idZadani)->select('zadania_id');  //idcka zadani, ktore maju ulohy
        $zadaniaSU = Zadania::whereIn('id',$idzadaniaSU)->get();

        $ulohyVs = Ulohy::whereIn('zadania_id',$idZadani)->get();      //vsetky ulohy v skuske




        $riesenia=Riesenia::whereIn('ulohy_id',$ulohy)->get();          //vsetky riesenia v skuske
        $studenti=Studenti::all();                                      //vsetci studenti v skuske


        //odoslanie txt cez nazov do zadani. aby sa vypocitali vysledky














        return view('skuska')->with(compact('lastName','persons','riesenia','studenti','zadania','ulohyVs','zadaniaSU'));


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

        $dest = '/public/vzorove/';
      //  $txt = request()->file('obrazok');
        $nazov = $request->file('obrazok')->getClientOriginalName();
        $ste=$request->file('obrazok')->storeAs($dest,$nazov);


        //$ste->save($dest . $nazov);

        // aktualizacia cesty pre obrazok a token

        $token = Str::random(10) ;

        $uloha=Ulohy::find($id);
        $uloha->update([
           'obrazok' => ('/app/public/vzorove/' . $nazov),
            'token' => ($token)
        ]);


        return back();
        //return redirect($nazov);
    }

    public function showU(Request $request){                //zobrazenie konfiguracie


        $uloha=$request->uloha;



        $post=Ulohy::find($uloha);

        $content = $post->obrazok;





        return view('uloha')->with(compact('post','content'));




    }

    public function storeU(Request $request){           //ulozenie 2 riadiacich poli

        /*
        $idd= $request->skuska;

        $skuska = Skusky::find($idd);
        $skuska->zadania()->create(request()->validate([
            "nazov" => "required|string|min:3"

        ]));

        */




        $box = $request->box;
        $boxS = $request->boxS;

        $pole = array();
        $poleS = array();



        $i=0;
        $size= $request->size;

        while($i<$size) {

            if (isset($box[$i])) {

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

        $i=0;
        $size= $request->sizeS;

        while($i<$size) {

            if (isset($boxS[$i])) {

                $poleS[] = 1;
                //dd('je 1');

            } else {
                //dd('nenastavene');
                $poleS[] = 0;

            }
            $i++;

        }

        $dbRiadiaceS=serialize($poleS);
        // dd(unserialize($dbRiadiace));


        $uloha=Ulohy::find($request->uloha);
        $uloha->update([
            'riadiace' => ($dbRiadiace),
            'riadiaceS' => ($dbRiadiaceS)
        ]);




            return back();
    }


    public function showIn(){               //zobrazenie formu pre vstup studenta


        return view('inputSkuska');

    }

    public function storeIn(Request $request){  //ulozenie udajov pri vstupe studenta


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


    public function showEx(Request $request){           //zobrazenie uloh skusky studentovi

        $ulohy=$request->session()->get('ulohy');
        $student=$request->session()->get('student');

        return view('exam', compact('ulohy', 'student'));

    }


    public function storeEx(Request $request){      //ulozenie konfiguracii studenta k uloham


        $obrazok = $request->file('obrazok');




        //  $txt = request()->file('obrazok');

        $dest = '/public/riesenia/';



        $i=0;
        foreach ($obrazok as $obr){

            $riesenie = new Riesenia();

            $riesenie->ulohy_id=$request->uloha[$i];

            $riesenie->studenti_id=$request->student;

            //ulozenie konfiguracie



            $nazov = $obr->getClientOriginalName();
            $obr->storeAs($dest,$nazov);
            $riesenie->konfiguracia='app/public/riesenia/'.$nazov;


            $i++;

            $riesenie->save();

        }


    }


    public function showR(Request $request){

        $riesenie=Riesenia::where('id','=',$request->riesenie)->first()->get();
        $idRiesenia=Riesenia::where('id','=',$request->riesenie)->first()->ulohy_id;
        $uloha=Ulohy::where('id','=',$idRiesenia)->first()->get();

        //dd($riesenie);

        return view('riesenie')->with(compact('riesenie','uloha'));






    }




}

