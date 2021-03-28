@extends('layouts.app')
@section('content')

<div class="container">

    @section('content')

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titolo</th>
                <th scope="col">User</th>
                <th scope="col">Content</th>
                <th scope="col">Info</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->content}}</td>
                <td><a href="{{route('post.show', $post->id)}}">Info</a></td>


                <td>
                    <a href="{{route('post.edit',['post' => $post->id])}}" class="btn btn-info">Modifica</a>
                    <form class="d-inline-block" action="{{route('post.destroy', $post->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endsection
</div>
@endsection