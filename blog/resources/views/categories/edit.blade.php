@extends('layouts.app')

@section('content')
    <form action="/kategorie/{{$category->id}}" method="POST" >
        @csrf
        @method('PATCH')
        <div class="input-wrapper catEdit ">
            <label for="nazov"> názov </label>
            <input id="nazov" type="text" name="nazov" placeholder="Nazov" value="{{$category->nazov}}">
        @error('nazov')                                                                 <!-- vracia php -->
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" id="submit"> Upravit</button>
        </div>




    </form>
@endsection
