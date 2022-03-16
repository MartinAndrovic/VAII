@extends('layouts.app')

@section('content')
    <div class="exam-show col-xl-10 ">






    @forelse($ulohy as $ulohy)   <!-- poslane z compact -->

        <h1 class="postName">{{$ulohy->nazov}}</h1>
        <p class="postUvod">{{$ulohy->nazov}}</p>
        <p class="postText">{{$ulohy->nazov}}</p>

        <form  method="POST"  enctype='multipart/form-data' >
            @csrf




                    <label for="obrazok"> konfiguracia </label>
                    <input id="obrazok" type="file" name="obrazok[]" >
                    <input type=hidden name="uloha[]" value="{{$ulohy->id}}">
                    <div class="alert-danger" id="obrazokError"></div>


            @error('nazov')                                                                 <!-- vracia php -->
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror




    @empty                           <!-- ak je prazdne -->
        <h2>zatiaľ žiadne skúšky</h2>
        @endforelse

            <button type="submit" class="submit"> ulozit </button>
        </form>


    </div>


@endsection
