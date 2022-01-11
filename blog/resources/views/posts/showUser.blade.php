@extends('layouts.app')

@section('content')
    <div class="post-show">

        <img src="/storage/{{$post->obrazok}}" alt="{{$post->nazov}}">



        <h1 class="postName">{{$post->nazov}}</h1>
        <p class="postUvod">{{$post->uvod}}</p>
        <p class="catText">Categoria: {{$post->category->nazov}}</p>
        <p class="catText">{{$post->text}}</p>

        <h2 class="comName">Komentáre</h2>


        @forelse($post->comments as $comment)

            <div class="comment">
                <p>{{$comment->text}}</p>
                <p>Napisal : {{$comment->user->name}}</p>
                <p>coje zase</p>
            </div>

        @empty
            <h2>Ziadne komentare</h2>

        @endforelse

        @auth

            <form action="/komentar" method="POST">
                @csrf
                <div class="input-wrapper ">
                    <label for="kategoria"> Komentar </label>
                    <input type="text" id="text" name="text" placeholder="Komentar">
                    @error('text')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="hidden" value="{{$post->id}}" name="post_id">
                    <button type="submit">komentovať</button>

                </div>
            </form>
        @endauth



        <a href="/posts/{{$post->id}}/edit">Edit</a>
        <form id="postDelete" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="post_id" value="{{$post->id}}" id="post_id_delete">
            <button type="submit">Vymazat</button>
        </form>


    </div>
@endsection
