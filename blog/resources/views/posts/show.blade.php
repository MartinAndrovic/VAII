@extends('layouts.app')

@section('content')
    <div class="post-show col-xl-10 ">
        <img src="/storage/{{$post->obrazok}}" alt="{{$post->nazov}}">
        <h1 class="postName">{{$post->nazov}}</h1>
        <p class="small catText">Kategória: {{$post->category->nazov}}</p>
        <p class="postUvod">{{$post->uvod}}</p>
        <p>{{$post->text}}</p>

        <h2 class="comName">Komentare</h2>

        <div class="commentare">
        @forelse($post->comments as $comment)
            <div class="comment">
                <p >{{$comment->text}}</p>
                <p>Napisal : {{$comment->user->name}}</p>
            </div>
        @empty
            <h2>Ziadne komentare</h2>
        @endforelse
        </div>

    @auth
        <!--   <h3>Tu napiste svoj komentar</h3> -->
            <form action="/komentar" method="POST">
                @csrf
                <div class="input-wrapper ">

                    <textarea type="text" id="text" name="text" placeholder="Komentar"> </textarea>

                    @error('text')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="hidden" value="{{$post->id}}" name="post_id">
                    <button  class="submit" type="submit">Komentovat</button>

                </div>
            </form>
        @endauth


    </div>
@endsection
