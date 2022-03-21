@extends('layouts.app')

@section('content')








    <?php

    use Illuminate\Support\Facades\Storage;







    $file = fopen(storage_path($content), "r");  ?>


    <form id="postUpdate1" method="POST" >
        @csrf
        <table border='4' class='stats' cellspacing='0'>

        </table>




            <?php



            $pole=array();
            $pole=unserialize($uloha->riadiace);

            $poleS=array();
            $poleS=unserialize($uloha->riadiaceS);
            //dd($pole);

            ?>











                            <?php

                                 $vzorovy = fopen(storage_path($uloha->obrazok), "r");

                                 $pocetRVz=0;
                                 $pocetOk=0;
                                 $indexB=0;
                                 $indexBS=0;

                                while(!feof($vzorovy)) {



                                    $odovzdany = fopen(storage_path($riesenie->konfiguracia), "r");



                                    $aktualnyRV= fgets($vzorovy);
                                    $poleRiadokV = explode(" ", $aktualnyRV);



                                    if($aktualnyRV !=  "!\r\n"){


                                        if($pole[$indexB]==0){


                                           // foreach($word_arr as $word){
                                             //   if($word!=""){

                                            $zhoda=0;


                                            // echo "<td>",$aktualnyRV,    "</td>";
                                            //  echo "<td>",$pocetRVz. "<br>", "</td>";

                                            while(!feof($odovzdany)){                //ku kazdemu riadku vzoroveho sa hlada riadok v rieseni

                                                $aktualnyRR= fgets($odovzdany);


                                                if($aktualnyRV == $aktualnyRR){

                                                    $poleRiadokR = explode(" ", $aktualnyRR);


                                                    $indexSlovo=0;
                                                    $chyba=0;

                                                    while($indexSlovo<sizeof($poleRiadokV)){
                                                       // echo "<td>",$poleRiadokV[$indexSlovo],    "</td>";
                                                       // echo "<td>",$poleRiadokR[$indexSlovo], "<br>",   "</td>";

                                                        if($poleS[$indexBS]==0){                //ak sa slovo kontroluje

                                                            if($poleRiadokV[$indexSlovo]==$poleRiadokR[$indexSlovo]){

                                                            }
                                                            else{
                                                                $chyba++;
                                                            }

                                                        }
                                                        $indexSlovo++;

                                                       // else{                   //ak sa slovo nkontroluje


                                                       // }

                                                    }

                                                    if($chyba==0){
                                                        $zhoda++;
                                                    }


                                                    //$zhoda++; tre pouzittttttttt
                                                // echo "<td>",$aktualnyRR,  "<br>",  "</td>";



                                                }


                                            }



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



                                }
                                        var_dump($pocetOk,$pocetRVz);



                                ?>








                                <?php
                                fclose($vzorovy);
                                fclose($odovzdany);
                                ?>


















        <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}">

        <!-- <button type="submit" class="submitBt"> Edit</button> -->




    </form>
@endsection
