@extends('layouts.app')

@section('content')



    <!--vytvorenie noveho zadania-->

    <form  method="POST"  enctype='multipart/form-data' >
        @csrf
        <div class="input-wrapper catEdit">
            <h1> vyplnte udaje</h1>
            <label for="meno"> meno </label>
            <input id="meno" type="text" name="meno" placeholder="meno">

            <label for="priezvisko"> priezvisko </label>
            <input id="priezvisko" type="text" name="priezvisko" placeholder="priezvisko">

            <label for="token"> token </label>
            <input id="token" type="text" name="token" placeholder="token">


        @error('meno')                                                                 <!-- vracia php -->
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="submit"> odoslat</button>
        </div>







    </form>

@endsection
