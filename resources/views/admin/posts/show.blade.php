@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>{{$post->title}}</h1>
            @if ($post->category)
            <div class="badge badge-primary">{{$post->category->name}}</div>   
            @endif
        </div>
        <div class="card-body">
            <div class="md-3">
                <h5>Tags</h5>
                <ul>
                    @foreach ($post->tags as $tag)
                    <li>{{$tag->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="md-3">
                <a href="{{route('admin.posts.index')}}" class="btn btn-primary">Back</a>
            </div>
            <div>
                {{$post->content}}
            </div>
            <div>
                <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-warning">Edit</a>
            </div>
        </div>
    </div>
</div>

    
@endsection