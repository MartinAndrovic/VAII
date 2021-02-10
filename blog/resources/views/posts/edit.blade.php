@extends('layouts.app')

@section('content')
    <form id="postUpdate" action="/posts/{{$post->id}}" method="POST" enctype='multipart/form-data'>
        @csrf
        @method('PATCH')
        <div class="input-wrapper">
            <label for="nazov"> Nazov </label>
            <input id="nazov" type="text" name="nazov" placeholder="Nazov" value="{{$post->nazov}}">
            <div class="alert-danger" id="nazovvError"></div>

        </div>

        <div class="input-wrapper">
            <label for="uvod"> uvod </label>
            <textarea id="uvod" type="text" name="uvod" placeholder="Uvod" >{{$post->uvod}} </textarea>
            <div class="alert-danger" id="uvodError"></div>

        </div>

        <div class="input-wrapper">
            <label for="text"> text </label>
            <textarea id="text" type="text" name="text" placeholder="Text" >{{$post->text}} </textarea>
            <div class="alert-danger" id="textError"></div>

        </div>

        <div class="input-wrapper ">
            <label for="kategoria"> Kategoria </label>
            <select name="kategoria" id="kategoria">
                @forelse($kategorie as $kategoria)
                    <option value="{{$kategoria->id}}" @if($kategoria->id == $post->category_id) selected @endif>{{$kategoria->nazov}}</option>
                @empty
                @endforelse
            </select>
            <div class="alert-danger" id="kategoriaError"></div>

        </div>

        <img src="/storage/{{$post->obrazok}}" alt="">
        <div class="input-wrapper ">
            <label for="obrazok"> text </label>
            <input id="obrazok" type="file" name="obrazok" >
            <div class="alert-danger" id="obrazokError"></div>
        </div>


        <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}">

        <button type="submit"> Edit</button>




    </form>
@endsection
