@extends('layouts.app')

@section('content')
    <h1 class="title">Kategorie</h1>


    <div class="categories" id="listCat">
        <a href="/kategorie/create" id="add" >Pridať kategóriu</a>
        @forelse($kategorie as $kategoria)
            <div id="item">
            <p>{{$kategoria->nazov}}</p>
        <div id="box">
            <a href="/kategorie/{{$kategoria->id}}" id="btn" class="submit">Edit</a>
    </div>
            </div>
        @empty
            <h2>zatiaľ žiadne kategórie</h2>
        @endforelse
    </div>
@endsection
