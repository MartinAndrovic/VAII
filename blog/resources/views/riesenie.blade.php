@extends('layouts.app')

@section('content')










    <form id="postUpdate1" method="POST" >
        @csrf

        <table style="float: left;" id="tabVzor" border=1 class='stats' cellspacing='0'>

            <tbody>

            </tbody>

            </table>


        <table style="display: inline-block" id="tabRies" border=1 class='stats' cellspacing='0'>

            <tbody>

            </tbody>

        </table>



        @forelse($uloha as $uloha)
            <?php





            ?>

            @forelse($riesenie as $riesenie)



                @if($riesenie->ulohy_id==$uloha->id)
                    <?php

                   // <div class="col-xl-3 col-md-5 col-sm-12 col-offset-3 post ">
                    //    <a href="/skuska/riesenie/{{$riesenie->id}}  ">
                       //     <div class="inner">

                    $pole=array();
                    $pole=unserialize($uloha->riadiace);

                    $poleS=array();
                    $poleS=unserialize($uloha->riadiaceS);
                    $chyba=0;
                    //dd($poleS);


                    $vzorovy = fopen(storage_path($uloha->obrazok), "r");

                    $pocetRVz=0;
                    $pocetOk=0;
                    $indexB=0;
                    $indexBS=0;

                    $hlavnyV=0;
                    $hlavnyV=0;
                    $predoslyHlavnyV=0;
                    $predoslyHlavnyR=0;

                    $poleVysledneR=array();



                    while(!feof($vzorovy)) {

                        $odovzdany = fopen(storage_path($riesenie->konfiguracia), "r");

                        $aktualnyRV= fgets($vzorovy);
                        $poleRiadokV = explode(" ", $aktualnyRV);



                        if($aktualnyRV !=  "!\r\n" && $aktualnyRV != false){


                           $zhoda=0;                            //asi zmazat
                           $uplneZhodny=0;

                           while(!feof($odovzdany)){                //hladanie riadku v rieseni
                                $aktualnyRR= fgets($odovzdany);

                                if($poleRiadokV[0]==""){
                                    if($aktualnyRV == $aktualnyRR && $predoslyHlavnyV==$predoslyHlavnyR){   //ak je aktualny zhodny

                                        $uplneZhodny++;

                                    }
                                }
                                else{

                                    if($aktualnyRV == $aktualnyRR && $predoslyHlavnyV==$predoslyHlavnyR){   //ak je aktualny zhodny

                                        $uplneZhodny++;

                                    }
                                }
                           }

                           fclose($odovzdany);

                           $indexx=0;                                  // zmena hlavneho riadku--------
                           $medzery=0;

                           while($indexx<sizeof($poleRiadokV)){

                                if($poleRiadokV[$indexx]==""){

                                   $medzery++;

                                }

                                $indexx++;
                           }

                           if($medzery==0){
                               $hlavnyV=$aktualnyRV;    //treba spravit predosli77777777777777777
                               $hlavnyR=$aktualnyRV;
                           }                                            // koniec zmena hlavneho riadku-------



                           if($uplneZhodny!=0){                        //ak su riadky zhodne
                                                    //zapis do vysledneho
                           }
                           else{     //treba prehladat riesenie a urcit cez poleS zhodu

                               if($pole[$indexB]==1){
                                                        //vypis
                               }


                               $odovzdany = fopen(storage_path($riesenie->konfiguracia), "r");
                               $najdenyRiadok=0;

                               while(!feof($odovzdany)){                //chyba az ked sa prejde cely a nebude ziadny zhodny riadok podla polaS

                                   $aktualnyRR= fgets($odovzdany);
                                   $poleRiadokR = explode(" ", $aktualnyRR);



                                   if(sizeof($poleRiadokV)==sizeof($poleRiadokR) && $predoslyHlavnyV==$predoslyHlavnyR){  //nasiel sa riadok ale nevieme ci zhodny

                                        $indexX=0;                              // na zistenie, ci je to riadok zhodny podla poleS-------
                                        while($indexX<sizeof($poleRiadokV)){    //prechadzanie slov jednoho riadku

                                            if($poleRiadokV[$indexX]!=$poleRiadokR[$indexX]){
                                                if($poleS[$indexBS]==0){
                                                $chybaRiadokS++;
                                                }
                                            }

                                         $indexX++;
                                        }

                                        if($chybaRiadokS==0){

                                            $najdenyRiadok++;

                                        }

                                   }
                               }
                               fclose($odovzdany);


                               if($najdenyRiadok==0){
                                   $chyba++;
                               }

                           }

                                                    $predoslyHlavnyR=$hlavnyR;

                        }

                                        $indexB++;
                    }

                    $predoslyHlavnyV=$hlavnyV;




                    fclose($vzorovy);
                    fclose($odovzdany);



                      ?>
                @endif



            @empty                           <!-- ak je prazdne -->
            <h2>zatiaľ žiadne riesenia</h2>

            @endforelse




        @empty                           <!-- ak je prazdne -->
        <h2>zatiaľ žiadne ulohy</h2>


        @endforelse



    </form>
@endsection
