@extends('layouts.app')

@section('content')
    <h1 class="title">Kategórie</h1>


    <div class="categories" id="listCat">
        <a href="/kategorie/create" id="add" >Pridať kategóriu</a>
        @forelse($kategorie as $kategoria)
            <div class="item">
            <p>{{$kategoria->nazov}}</p>
        <div class="box">
            <a href="/kategorie/{{$kategoria->id}}"  class="submit btn">Edit</a>
    </div>
            </div>
        @empty
            <h2>zatiaľ žiadne kategórie</h2>
        @endforelse
    </div>
@endsection
