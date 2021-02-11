@extends('layouts.app')

@section('content')
    <form action="/kategorie" method="POST" >
        @csrf
        <div class="input-wrapper catEdit">
            <label for="nazov"> názov </label>
            <input id="nazov" type="text" name="nazov" placeholder="názov">
        @error('nazov')                                                                 <!-- vracia php -->
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="submit"> vytvoriť</button>
        </div>







    </form>
@endsection
