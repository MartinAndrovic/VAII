@extends('layouts.app')

@section('content')
    <div class="post-show">
        <img src="/storage/{{$post->obrazok}}" alt="{{$post->nazov}}">
        <p class="small">Kategória: {{$post->category->nazov}}</p>
        <h1>{{$post->nazov}}</h1>
        <p>{{$post->text}}</p>

        <h2>Komentare</h2>
        @auth
            <h3>Tu napiste svoj komentar</h3>
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
        <div class="commentare">
        @forelse($post->comments as $comment)
            <div class="comment">
                <p>{{$comment->text}}</p>
                <p>Napisal : {{$comment->user->name}}</p>
            </div>
        @empty
            <h2>Ziadne komentare</h2>
        @endforelse
        </div>


    </div>
@endsection
