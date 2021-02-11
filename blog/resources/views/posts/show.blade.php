@extends('layouts.app')

@section('content')
    <div class="post-show col-xl-10 ">
        <img src="/storage/{{$post->obrazok}}" alt="{{$post->nazov}}">
        <h1 class="postName">{{$post->nazov}}</h1>
        <p class="small catText">Kategória: {{$post->category->nazov}}</p>
        <p class="postUvod">{{$post->uvod}}</p>
        <p class="postText">{{$post->text}}</p>

        <h2 class="comName">Komentáre</h2>

        <div class="commentare">
        @forelse($post->comments as $comment)
            <div class="comment">

                <p class="comAutor"> {{$comment->user->name}}</p>
                <p class="comText" >{{$comment->text}}</p>
                <p class="comText" >{{$comment->text}}</p>
            </div>
        @empty
            <h2 class="noCom">zatiaľ žiadne komentáre</h2>
        @endforelse
        </div>

    @auth
        <!--   <h3>Tu napiste svoj komentar</h3> -->
            <form action="/komentar" method="POST">
                @csrf
                <div class="input-wrapper ">

                    <textarea  id="text" name="text" placeholder="Komentar"> </textarea>

                    @error('text')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="hidden" value="{{$post->id}}" name="post_id">
                    <button  class="submit" type="submit">Komentovat</button>

                </div>
            </form>




            <a href="/posts/{{$post->id}}/edit">Edit</a>
            <form id="postDelete" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="post_id" value="{{$post->id}}" id="post_id_delete">
                <button type="submit">Vymazat</button>
            </form>
        @endauth




    </div>
@endsection
