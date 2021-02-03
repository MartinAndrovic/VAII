@extends('layouts.app')

@section('content')
    <form action="/kategorie" method="POST" >
        @csrf
        <div class="input-wrapper">
            <label for="nazov"> Nazov </label>
            <input id="nazov" type="text" name="nazov" placeholder="Nazov">
        @error('nazov')                                                                 <!-- vracia php -->
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>


        <button type="submit"> vytvorit</button>




    </form>
@endsection
