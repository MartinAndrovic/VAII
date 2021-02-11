@extends('layouts.app')

@section('content')
    <h1 class="title" >Moje príspevky</h1>
    <div class="container">
        <div class="row justify-content-around">
        @forelse($prispevky as $prispevok)   <!-- poslane z compact -->
            <a href="/posts/{{$prispevok->id}}">
                <div class="col-xl-3 col-md-5 col-sm-12 col-offset-3 post ">
                    <div class="inner">
                        <img src="/storage/{{$prispevok->obrazok}}" alt="{{$prispevok->nazov}}">
                        <div class="text text-center">
                            <a href="/posts/{{$prispevok->id}}"><h2 class="text-center">{{$prispevok->nazov}}</h2></a>
                            <p>{{$prispevok->uvod}}</p>
                            <div class="row inner-bottom">
                                <div class="col-5 col-offset-1">
                                    <p class="small catText">Kategória : {{$prispevok->category->nazov}}</p>
                                </div>
                                <div class="col-5 col-offset-1">
                                    <h3 class="small">Autor : {{$prispevok->user->name}}</h3>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </a>

        @empty                           <!-- ak je prazdne -->
            <h2>zatiaľ žiadne príspevky</h2>
            @endforelse

        </div>
    </div>
@endsection
