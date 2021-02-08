@extends('layouts.app')

@section('content')
    <h1>Kategorie</h1>


    <div class="categories" id="listCat">
        <a href="/kategorie/create" id="add" >Pridat kategoriu</a>
        @forelse($kategorie as $kategoria)
            <div id="item">
            <p>{{$kategoria->nazov}}</p>
        <div id="box">
            <a href="/kategorie/{{$kategoria->id}}" id="btn">Edit</a>
    </div>
            </div>
        @empty
            <h2>ziadne kategorie</h2>
        @endforelse
    </div>
@endsection
