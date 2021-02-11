@extends('layouts.app')

@section('content')
    <h1 class="title">Príspevky</h1>
    <div class="container">
       <div class="row justify-content-around">
           @forelse($prispevky as $prispevok)   <!-- poslane z compact -->

               <div class="col-xl-3 col-md-5 col-sm-12 col-offset-3 post ">
                   <a href="/posts/{{$prispevok->id}}">
                    <div class="inner">
                        <img src="/storage/{{$prispevok->obrazok}}" alt="{{$prispevok->nazov}}">
                        <div class="text text-center">
                            <h2 class="text-center">{{$prispevok->nazov}}</h2>
                            <p class="postUvod">{{$prispevok->uvod}}</p>
                            <div class="row inner-bottom">
                                <div class="col-5 col-offset-1">
                                    <p class="small catText">Kategoria : {{$prispevok->category->nazov}}</p>
                                </div>
                                <div class="col-5 col-offset-1">
                                    <h3 class="small postAutor">Autor : {{$prispevok->user->name}}</h3>
                                </div>
                            </div>

                        </div>
                   </div>
                   </a>
               </div>


           @empty                           <!-- ak je prazdne -->
           <h2>zatiaľ žiadne príspevky</h2>
           @endforelse

       </div>
    </div>
@endsection
