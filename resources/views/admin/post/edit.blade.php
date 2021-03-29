@extends('layouts.app')
@section('content')

<div class="container">
    <h4>Inserisci post</h4>
    

    <form action="{{route('post.update', $post->id)}}" method="post">
    @method('PUT')
    @csrf
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" name="title" id="title" value="{{$post->title}}">
        </div>

        @if ($post -> cover)
            <h4>Immagine</h4>
            <img style="width: 10rem;"  src="{{ asset('storage/' .$post->cover) }}" alt="">
        @endif
        <form method="POST" action="{{ route('post.update', $post) }}" enctype="multipart/form-data">
        <div class="form-group">
          <label for="immagine">Add file</label>
          <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
        </div>

        <div class="form-group">
            <label for="content">content</label>
            <textarea class="form-control" name="content" id="content" rows="3">{{$post->content}}</textarea>
        </div>

        @foreach ($tags as $tag)
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="tags[]" value="{{$tag->id}}" {{$post->tags->contains($tag->id) ? 'checked' : ''}}>
            <label class="form-check-label" for="exampleCheck1">{{$tag->name}}</label>
        </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>

@endsection 