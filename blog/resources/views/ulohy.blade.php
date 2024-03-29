@extends('layouts.app')

@section('content')
    <h1 class="title">Skuska-zadania </h1>
    {{$url}}
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
            <h2>zatiaľ žiadne ulohy</h2>
            @endforelse

        </div>
    </div>


    <!--vytvorenie noveho zadania-->

    <form  method="POST"  enctype='multipart/form-data' >
        @csrf
        <div class="input-wrapper catEdit">
            <h1> pridat ulohu</h1>
            <label for="nazov"> názov </label>
            <input id="nazov" type="text" name="nazov" placeholder="názov">

            <div class="input-wrapper ">
                <label for="obrazok"> konfiguracia </label>
                <input id="obrazok" type="file" name="obrazok" >
                <div class="alert-danger" id="obrazokError"></div>

            </div>
        @error('nazov')                                                                 <!-- vracia php -->
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="submit"> vytvoriť</button>
        </div>







    </form>

@endsection
