@extends('layouts.app')

@section('content')










    <form id="postUpdate1" method="POST" >
        @csrf

        <table id="tabVzor" border=4 class='stats' cellspacing='0'>

            <tbody>
            <tr>
                <td>initial row</td>
            </tr>
            </tbody>

            </table>


        <table id="tabRies" border=4 class='stats' cellspacing='0'>

            <tbody>
            <tr>
                <td>initial row</td>
            </tr>
            </tbody>

        </table>



            @forelse($uloha as $uloha)
            @forelse($riesenie as $riesenie)

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



                                    $odovzdany = fopen(storage_path($uloha->obrazok), "r");



                                    $aktualnyRV= fgets($vzorovy);
                                    $poleRiadokV = explode(" ", $aktualnyRV);





                                    if($aktualnyRV !=  "!\r\n"){


                                        if($pole[$indexB]==0){


                                           // foreach($word_arr as $word){
                                             //   if($word!=""){

                                            $zhoda=0;

                                            $akt=$aktualnyRV;

?>






                                <?php



                                            while(!feof($odovzdany)){                //ku kazdemu riadku vzoroveho sa hlada riadok v rieseni

                                                $aktualnyRR= fgets($odovzdany);


                                                if($aktualnyRV == $aktualnyRR){





                                                    $poleRiadokR = explode(" ", $aktualnyRR);
?>

                                                      <script type="text/javascript">


                                                         myHtmlContent=<?php echo json_encode($akt); ?>





                                                         var tbodyRef = document.getElementById('tabRies').getElementsByTagName('tbody')[0];;
                                                         var newRow = tbodyRef.insertRow();
                                                         newRow.innerHTML = myHtmlContent;




                </script>
            <?php

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




















        <!-- <button type="submit" class="submitBt"> Edit</button> -->


            @empty
                <h2>zatiaľ žiadne riesenia</h2>
            @endforelse


        @empty
            <h2>zatiaľ žiadne riesenia</h2>
        @endforelse


    </form>
@endsection
