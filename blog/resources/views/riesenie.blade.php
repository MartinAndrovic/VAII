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



            $pole=array();
            $pole=unserialize($uloha->riadiace);

            $poleS=array();
            $poleS=unserialize($uloha->riadiaceS);
            //dd($poleS);

            ?>

            @forelse($riesenie as $riesenie)



                @if($riesenie->ulohy_id==$uloha->id)
                    <?php

                   // <div class="col-xl-3 col-md-5 col-sm-12 col-offset-3 post ">
                    //    <a href="/skuska/riesenie/{{$riesenie->id}}  ">
                       //     <div class="inner">




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

                                //$polee=array();

                                //while(!feof($vzorovy)){
                                // $polee[]=fgets($vzorovy);
                                // }
                                // dd($polee);

                                while(!feof($vzorovy)) {



                                    $odovzdany = fopen(storage_path($riesenie->konfiguracia), "r");



                                    $aktualnyRV= fgets($vzorovy);
                                    $poleRiadokV = explode(" ", $aktualnyRV);



                                    if($aktualnyRV !=  "!\r\n" && $aktualnyRV != false){


                                        if($pole[$indexB]==0){              //if 1




                                            $zhoda=0;
                                            $uplneZhodny=0;




                                            while(!feof($odovzdany)){                //hladanie riadku v rieseni

                                                $aktualnyRR= fgets($odovzdany);




                                                if($aktualnyRV == $aktualnyRR && $predoslyHlavnyV==$predoslyHlavnyR){   //ak je aktualny zhodny
                                                    $uplneZhodny++;

                                                 }
                                            }

                                                $indexx=0;                                  // zmena hlavneho riadku--------
                                                $medzery=0;


                                                while($indexx<sizeof($poleRiadokV)){


                                                    if($poleRiadokV[$indexx]==""){

                                                     $medzery++;

                                                    }

                                                    $indexx++;
                                                }

                                                if($medzery==0){
                                                    $hlavnyV=$aktualnyRV;    //treba spravit predosli
                                                    $hlavnyR=$aktualnyRV;
                                                }                                            // koniec zmena hlavneho riadku-------


                                                if($uplneZhodny!=0){
                                                    //zapis do vysledneho
                                                 }









                                                    $poleRiadokR = explode(" ", $aktualnyRR);






                                                      //dorobit kod ked sa nenajdu riadky


                                                    $chyba=0;
                                                    $indexSlovo=0;
                                                    $checkH=0;








                                                    while($indexSlovo<sizeof($poleRiadokV)){        //spracovanie riadku
                                                        //echo "<td>",$poleRiadokV[$indexSlovo],    "</td>";
                                                        // echo "<td>",$poleRiadokR[$indexSlovo], "<br>",   "</td>";

                                                        //if($indexBS<375){
                                                        //    echo "<td>",$poleRiadokV[$indexSlovo]." ",    "</td>";

                                                        if($poleRiadokV[$indexSlovo]!=""){



                                                        }
                                                        if($poleRiadokV[$indexSlovo]==""){
                                                            $checkH=1;
                                                        }
                                                        else{
                                                            $hlavnyV=$aktualnyRV;     //zmena
                                                            $hlavnyR=$aktualnyRR;      //zmena
                                                        }


                                                        if($poleS[$indexBS]==0){//ak sa slovo kontroluje

                                                            //if($checkH==0){

                                                            if($poleRiadokV[$indexSlovo]==$poleRiadokR[$indexSlovo]){

                                                            }
                                                            else{
                                                                $chyba++;
                                                            }




                                                        }

                                                        if($poleRiadokV[$indexSlovo]!=""){

                                                            $indexBS++;
                                                        }

                                                        $indexSlovo++;



                                                    }
                                                   // var_dump($pocetRVz);


                                                    //var_dump($indexBS);

                                                    if($chyba==0){
                                                        $zhoda++;
                                                    }


                                                    //$zhoda++; tre pouzittttttttt
                                                    // echo "<td>",$aktualnyRR,  "<br>",  "</td>";


                                                    $predoslyHlavnyR=$hlavnyR;










                                            if($zhoda!=0){
                                                $pocetOk++;
                                            }

                                            $pocetRVz++;





                                        }

                                        else{






                                            foreach($poleRiadokV as $word){
                                                if($word!=""){

                                                    $indexBS++;}}




                                        }

                                        $indexB++;
                                    }

                                    $predoslyHlavnyV=$hlavnyV;

                                }
                                //  var_dump($pocetOk,$pocetRVz);



                                ?>








                                <?php
                                fclose($vzorovy);
                                fclose($odovzdany);



                           // </div>
                    //</div>
                     ?>
                @endif

                }

            @empty                           <!-- ak je prazdne -->
            <h2>zatiaľ žiadne riesenia</h2>

            @endforelse




        @empty                           <!-- ak je prazdne -->
        <h2>zatiaľ žiadne ulohy</h2>


        @endforelse



    </form>
@endsection
