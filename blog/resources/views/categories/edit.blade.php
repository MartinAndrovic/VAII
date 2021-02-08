@extends('layouts.app')

@section('content')
    <form action="/kategorie/{{$category->id}}" method="POST" id="postCreate" >
        @csrf
        @method('PATCH')
        <div class="input-wrapper">
            <label for="nazov"> Nazov </label>
            <input id="nazov" type="text" name="nazov" placeholder="Nazov" value="{{$category->nazov}}">
        @error('nazov')                                                                 <!-- vracia php -->
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>


        <button type="submit" id="submit"> Upravit</button>




    </form>
@endsection
