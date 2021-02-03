@extends('layouts.app')

@section('content')
    <div class="post-show">
        <a href="/posts/{{$post->id}}/edit">Edit</a>
        <form id="postDelete" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="post_id" value="{{$post->id}}" id="post_id_delete">
            <button type="submit">Vymazat</button>
        </form>
        <img src="/storage/{{$post->obrazok}}" alt="{{$post->nazov}}">
        <h1>{{$post->nazov}}</h1>
        <p>Categoria: {{$post->category->nazov}}</p>
        <p>{{$post->text}}</p>

        <h2>Komentare</h2>
        @auth
            <h3>Komentovat vlastny prispevok</h3>
            <form action="/komentar" method="POST">
                @csrf
                <div class="input-wrapper ">
                    <label for="kategoria"> Komentar </label>
                    <input type="text" id="text" name="text" placeholder="Komentar">
                    @error('text')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="hidden" value="{{$post->id}}" name="post_id">
                    <button type="submit">Komentovat</button>

                </div>
            </form>
        @endauth

        @forelse($post->comments as $comment)
            <div class="comment">
                <p>{{$comment->text}}</p>
                <p>Napisal : {{$comment->user->name}}</p>
            </div>
        @empty
            <h2>Ziadne komentare</h2>
        @endforelse



    </div>
@endsection
