@extends('layouts.app')

@section('content')
    <form action="/posts" method="POST" enctype='multipart/form-data' id="postCreate">
        @csrf
        <div class="input-wrapper">
            <label for="nazov"> Nazov </label>
            <input id="nazov" type="text" name="nazov" placeholder="Nazov">
                                                                             <!-- vracia php -->
            <div class="alert-danger" id="nazovvError"></div>


        </div>

        <div class="input-wrapper">
            <label for="uvod"> uvod </label>
            <textarea id="uvod" > </textarea>
            <div class="alert-danger" id="uvodError"></div>

        </div>

        <div class="input-wrapper">
            <label for="text"> text </label>
            <textarea id="text" > </textarea>
            <div class="alert-danger" id="textError"></div>

        </div>

        <div class="input-wrapper ">
            <label for="obrazok"> Obrazok </label>
            <input id="obrazok" type="file" name="obrazok" >
            <div class="alert-danger" id="obrazokError"></div>

        </div>

        <div class="input-wrapper ">
            <label for="kategoria"> Kategoria </label>
            <select name="kategoria" id="kategoria">
                @forelse($kategorie as $kategoria)
                    <option value="{{$kategoria->id}}">{{$kategoria->nazov}}</option>
                @empty
                @endforelse
            </select>
            <div class="alert-danger" id="kategoriaError"></div>

        </div>

       <button type="submit" class="submitBt"> vytvorit</button>




    </form>
@endsection
