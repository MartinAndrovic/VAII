@extends('layouts.app')

@section('content')
    <form action="/posts" method="POST" enctype='multipart/form-data' id="postCreate">
        @csrf
        <div class="input-wrapper">
            <label for="nazov"> názov </label>
            <input id="nazov" type="text" name="nazov" placeholder="Nazov">
            <!-- vracia php -->
            <div class="alert-danger" id="nazovvError"></div>


        </div>



        <div class="input-wrapper ">
            <label for="obrazok"> obrázok </label>
            <input id="obrazok" type="file" name="obrazok" >
            <div class="alert-danger" id="obrazokError"></div>

        </div>


        <button type="submit" class="submitBt"> vytvorit</button>




    </form>
@endsection
