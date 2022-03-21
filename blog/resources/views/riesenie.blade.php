@extends('layouts.app')

@section('content')










    <form id="postUpdate1" method="POST" >
        @csrf

        <table style="float: left;" id="tabVzor" border=1 class='stats' cellspacing='0'>

            <tbody>

            </tbody>

            </table>


        <table style="display: inline-block" id="tabRies" border=4 class='stats' cellspacing='0'>

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


                                        if($pole[$indexB]==0){


                                            // foreach($word_arr as $word){
                                            //   if($word!=""){

                                            $zhoda=0;


                                            // echo "<td>",$aktualnyRV,    "</td>";
                                            //  echo "<td>",$pocetRVz. "<br>", "</td>";

                                            while(!feof($odovzdany)){                //ku kazdemu riadku vzoroveho sa hlada riadok v rieseni

                                                $aktualnyRR= fgets($odovzdany);




                                                if($aktualnyRV == $aktualnyRR && $predoslyHlavnyV==$predoslyHlavnyR){

                                                   // echo "<td>",$aktualnyRV, "<br>",    "</td>";
                                                   // echo "<td>",$aktualnyRR, "<br>",    "</td>";

                                                    $poleRiadokR = explode(" ", $aktualnyRR);
                                                    ?>





                                    <?php


                                                    $chyba=0;
                                                    $indexSlovo=0;
                                                    $checkH=0;
                                                    ?>


                                                        <script type="text/javascript">


                                                         myHtmlContent=<?php echo json_encode($poleRiadokR[$indexSlovo]); ?>





                                                        var tbodyRef = document.getElementById('tabRies').getElementsByTagName('tbody')[0];;
                                                        var newRow = tbodyRef.insertRow();





                                                        </script>

                    <?php


                                                    while($indexSlovo<sizeof($poleRiadokV)){        //spracovanie riadku
                                                        //echo "<td>",$poleRiadokV[$indexSlovo],    "</td>";
                                                        // echo "<td>",$poleRiadokR[$indexSlovo], "<br>",   "</td>";

                                                        //if($indexBS<375){
                                                        //    echo "<td>",$poleRiadokV[$indexSlovo]." ",    "</td>";

                                                        if($poleRiadokV[$indexSlovo]!=""){


                                                        ?>


                                                         <script type="text/javascript">


                                                         myHtmlContent=<?php echo json_encode($poleRiadokR[$indexSlovo]); ?>





                                                        // var tbodyRef = document.getElementById('tabRies').getElementsByTagName('tbody')[0];;
                                                         //var newRow = tbodyRef.insertRow();

                                                           // newRow.innerHTML = "<td> " +myHtmlContent+ "</td>";

                                                         var TD = document.createElement('td'); //Create new cell
                                                         TD.innerHTML = myHtmlContent; //Set some thing
                                                         newRow.appendChild (TD); //Add it to row




                                                        // myHtmlContent=<?php echo json_encode($poleRiadokV[$indexSlovo]); ?>





                                                      //  var tbodyRef = document.getElementById('tabVzor').getElementsByTagName('tbody')[0];;
                                                       // var newRow = tbodyRef.insertRow();
                                                       // newRow.innerHTML = "<td>" +myHtmlContent+"<td>";







                            </script>
                    <?php

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



                                                            //}



                                                            // }
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
