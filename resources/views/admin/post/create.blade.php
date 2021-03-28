@extends('layouts.app')
@section('content')

<div class="container">
    <h4>New post</h4>

    <form action="{{route('post.store')}}" method="post">
    @method('POST')
    @csrf
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" name="title" id="title">
        </div>
        <div class="form-group">
            <label for="content">content</label>
            <textarea class="form-control" name="content" id="content" rows="3"></textarea>
        </div>

        @foreach ($tags as $tag)
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="tags[]" value="{{$tag->id}}">
            <label class="form-check-label" for="exampleCheck1">{{$tag->name}}</label>
        </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>

@endsection