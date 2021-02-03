@extends('layouts.app')

@section('content')
    <h1>Prispevky</h1>
    <div class="container">
       <div class="row justify-content-around">
           @forelse($prispevky as $prispevok)   <!-- poslane z compact -->
               <div class="col-xl-3 col-md-5 col-sm-12 post">

                   <img src="/storage/{{$prispevok->obrazok}}" alt="{{$prispevok->nazov}}">
                   <a href="/posts/{{$prispevok->id}}"><h2>{{$prispevok->nazov}}</h2></a>
                   <p>Kategoria : {{$prispevok->category->nazov}}</p>
                   <p>{{$prispevok->uvod}}</p>

                   <p>Autor : {{$prispevok->user->name}}</p>
               </div>


           @empty                           <!-- ak je prazdne -->
           <h2>Ziadne prispevky</h2>
           @endforelse

       </div>
    </div>
@endsection
