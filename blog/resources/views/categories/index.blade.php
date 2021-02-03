@extends('layouts.app')

@section('content')
    <h1>Kategorie</h1>
    <a href="/kategorie/create">Pridat kategoriu</a>
    <div class="categories">
        @forelse($kategorie as $kategoria)
            <p>{{$kategoria->nazov}}</p>
            <a href="/kategorie/{{$kategoria->id}}">Edit</a>
        @empty
            <h2>ziadne kategorie</h2>
        @endforelse
    </div>
@endsection
