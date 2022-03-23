@extends('layouts.app')

@section('content')






    <form id="postUpdate1" method="POST" >
    @csrf






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
                    $pocetChyb=0;
                    $indexB=0;
                    $indexBS=0;

                    $vypisV=array();
                    $indexVypisV=0;
                    $vypisVz=array();
                    $indexVypisVz=0;

                    $hlavnyV=0;
                    $hlavnyV=0;
                    $predoslyHlavnyV=0;
                    $predoslyHlavnyR=0;

                    $poleVysledneR=array();


                    $indexRiesenie=0;
                    while(!feof($vzorovy)) {

                        $odovzdany = fopen(storage_path($riesenie->konfiguracia), "r");

                        $aktualnyRV= fgets($vzorovy);
                        $poleRiadokV = explode(" ", $aktualnyRV);



                        if($aktualnyRV !=  "!\r\n" && $aktualnyRV != false){


                           $zhoda=0;                            //asi zmazat
                           $uplneZhodny=0;


                           while(!feof($odovzdany)){                //hladanie riadku v rieseni
                                $aktualnyRR= fgets($odovzdany);
                                $poleRiadokR = explode(" ", $aktualnyRR);

                                if($poleRiadokV[0]==""){
                                    if($aktualnyRV == $aktualnyRR && $predoslyHlavnyV==$predoslyHlavnyR){   //ak je aktualny zhodny

                                        $uplneZhodny++;


                                        $indexRiesenie++;



                                        $vypisV[$indexVypisV]= '<tr>';
                                        $indexVypisV++;

                                        foreach ($poleRiadokR as $slovo){
                                            if($slovo !=""){


                                        $vypisV[$indexVypisV]= '<td>';
                                            $indexVypisV++;
                                            $vypisV[$indexVypisV]= $slovo;
                                            $indexVypisV++;
                                        $vypisV[$indexVypisV]= '</td>';
                                        $indexVypisV++;
                                                            }

                                            }


                                            foreach ($poleRiadokV as $slovo){
                                            if($slovo !=""){


                                                $vypisV[$indexVypisV]= '<td>';
                                                $indexVypisV++;
                                                $vypisV[$indexVypisV]= $slovo;
                                                $indexVypisV++;
                                                $vypisV[$indexVypisV]= '<input type=checkbox name=boxS[$x] >';
                                                $indexVypisV++;
                                                $vypisV[$indexVypisV]= '</td>';
                                                $indexVypisV++;

                                            }

                                        }

                                         $vypisV[$indexVypisV]= '<tr>';
                                        $indexVypisV++;













                                    }
                                }
                                else{

                                    if($aktualnyRV == $aktualnyRR ){   //ak je aktualny zhodny

                                        $uplneZhodny++;

                                        $indexRiesenie++;

                                        $vypisV[$indexVypisV]= '<tr>';
                                        $indexVypisV++;

                                        foreach ($poleRiadokR as $slovo){
                                            if($slovo !=""){


                                                $vypisV[$indexVypisV]= '<td>';
                                                $indexVypisV++;
                                                $vypisV[$indexVypisV]= $slovo;
                                                $indexVypisV++;
                                                $vypisV[$indexVypisV]= '</td>';
                                                $indexVypisV++;
                                            }

                                        }
                                        $vypisV[$indexVypisV]= '</tr>';
                                        $indexVypisV++;


                                        $vypisVz[$indexVypisVz]= '<tr>';
                                        $indexVypisVz++;

                                        foreach ($poleRiadokV as $slovo){
                                            if($slovo !=""){


                                                $vypisVz[$indexVypisVz]= '<td>';
                                                $indexVypisVz++;
                                                $vypisVz[$indexVypisVz]= $slovo;
                                                $indexVypisVz++;
                                                $vypisVz[$indexVypisVz]= '</td>';
                                                $indexVypisVz++;
                                            }

                                        }
                                        $vypisVz[$indexVypisVz]= '</tr>';
                                        $indexVypisVz++;





                                    }

                                    

                                }

                                if($poleRiadokR[0]!="" && $aktualnyRR!="!\r\n"){
                                    $predoslyHlavnyR=$aktualnyRR;
                                    //$vypisV[$indexVypisV]="predoslyRPoBezMedz ".$predoslyHlavnyR;
                                   //$indexVypisV++;
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
                           }                                           // koniec zmena hlavneho riadku-------



                           if($uplneZhodny!=0){                        //hlavny if----------------------------

                                                    //zapis do vysledneho





                               $pocetOk++;
                           }
                           else{     //treba prehladat riesenie a urcit cez poleS zhodu


                               if($pole[$indexB]==1){
                                                        //vypis

                                   $pocetOk++;

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
                                            $indexBS++;
                                        }

                                        if($chybaRiadokS==0){

                                            $najdenyRiadok++;

                                        }

                                   }
                               }
                               fclose($odovzdany);


                               if($najdenyRiadok==0){
                                   $pocetChyb++;
                               }
                               else{
                                   $pocetOk++;
                               }

                           }

                                                    //$predoslyHlavnyR=$hlavnyR;
                           $pocetRVz++;
                            $indexB++;
                        }



                        $predoslyHlavnyV=$hlavnyV;
                        //var_dump($predoslyHlavnyV);
                    }






                    fclose($vzorovy);
                    fclose($odovzdany);
                    //_dump($pocetOk,$pocetRVz,$pocetChyb);

                    $index=0;


                    echo "<table style='display: inline-block;' id=tabRies border=1 class='stats' cellspacing='0'>";

                    while ($index<sizeof($vypisV)){
                        echo $vypisV[$index];
                       $index++;
                    }

                    echo "</table>";


                     echo "<table style='float: left;' id=tabVzor border=1 class='stats' cellspacing='0'>";

                     $index=0;

                    while ($index<sizeof($vypisVz)){
                        echo $vypisVz[$index];
                        $index++;
                    }
                    echo "</table>"

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
