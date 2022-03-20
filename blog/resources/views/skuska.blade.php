@extends('layouts.app')

@section('content')
    <h1 class="title">Skuska-zadania </h1>
    <div class="container">
        <div class="row justify-content-around">


        @forelse($persons as $prispevok)   <!-- poslane z compact -->

            <div class="col-xl-3 col-md-5 col-sm-12 col-offset-3 post ">
                <a href="{{$lastName}}/{{$prispevok->id}}  ">
                    <div class="inner">

                        <div class="text text-center">
                            <h2 class="text-center">{{$prispevok->nazov}}</h2>

                            <div class="row inner-bottom">
                                <div class="col-5 col-offset-1">
                                </div>
                                <div class="col-5 col-offset-1">

                                </div>
                            </div>

                        </div>
                    </div>
                </a>
            </div>


        @empty                           <!-- ak je prazdne -->
            <h2>zatiaľ žiadne zadania</h2>
            @endforelse

        </div>
    </div>


    <!--vytvorenie noveho zadania-->

    <form  method="POST" >
        @csrf
        <div class="input-wrapper catEdit">
            <h1> pridat zadanie</h1>
            <label for="nazov"> názov </label>
            <input id="nazov" type="text" name="nazov" placeholder="názov">
        @error('nazov')                                                                 <!-- vracia php -->
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="submit"> vytvoriť</button>
        </div>







    </form>





    <h1 class="title">Riesenia </h1>
    <div class="container">
        <div class="row justify-content-around">




        @forelse($zadania as $idZadania)   <!-- poslane z compact -->

            <div class="col-xl-3 col-md-5 col-sm-12 col-offset-3 post ">
            <!--      <a href="{{$lastName}}/{{$prispevok->id}}  "> -->
                <div class="inner">

                    <h2 class="text-center">{{$idZadania->id}}</h2>

                    @forelse($ulohyVs as $uloha)
                        <?php
                        $pole=array();
                        $pole=unserialize($uloha->riadiace);
                        //dd($pole);

                        ?>

                        @forelse($riesenia as $riesenie)


                            @if($riesenie->ulohy_id==$uloha->id)

                                <?php

                                 $vzorovy = fopen(storage_path($uloha->obrazok), "r");

                                 $pocetRVz=0;
                                 $pocetOk=0;
                                 $indexB=0;

                                while(!feof($vzorovy)) {



                                    $odovzdany = fopen(storage_path($riesenie->konfiguracia), "r");



                                    $aktualnyRV= fgets($vzorovy);


                                    if($aktualnyRV !=  "!\r\n"){


                                        if($pole[$indexB]==0){

                                            $zhoda=0;


                                            // echo "<td>",$aktualnyRV,    "</td>";
                                            //  echo "<td>",$pocetRVz. "<br>", "</td>";

                                            while(!feof($odovzdany)){                //ku kazdemu riadku vzoroveho sa hlada riadok v rieseni

                                                $aktualnyRR= fgets($odovzdany);


                                                if($aktualnyRV == $aktualnyRR){
                                                $zhoda++;
                                                // echo "<td>",$aktualnyRR,  "<br>",  "</td>";



                                                }


                                            }



                                            if($zhoda!=0){
                                                $pocetOk++;
                                            }

                                            $pocetRVz++;





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



                            @endif

                            @empty                           <!-- ak je prazdne -->
                                <h2>zatiaľ žiadne riesenia</h2>

                        @endforelse

                        @empty                           <!-- ak je prazdne -->
                            <h2>zatiaľ žiadne ulohy</h2>

                    @endforelse

                    @foreach($studenti as $student)

                        @if($prispevok->studenti_id==$student->id)

                            <h2 class="text-center">{{$student->meno}}</h2>
                            <h2 class="text-center">{{$student->priezvisko}}</h2>

                        @endif

                    @endforeach

                    <div class="text text-center">
                        <h2 class="text-center">{{$prispevok->id}}</h2>

                        <div class="row inner-bottom">
                            <div class="col-5 col-offset-1">
                            </div>
                            <div class="col-5 col-offset-1">

                            </div>
                        </div>

                    </div>
                </div>
                </a>
            </div>


        @empty                           <!-- ak je prazdne -->
            <h2>zatiaľ žiadne zadania</h2>
            @endforelse



        </div>
    </div>

@endsection
