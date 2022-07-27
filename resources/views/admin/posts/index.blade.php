@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Lista post</h1>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <a href="{{route('admin.posts.create')}}" class="btn btn-success">Crea post</a>
            </div>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">slug</th>
                    <th scope="col">content</th>
                    <th scope="col">status</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->slug}}</td>
                        <td class="text-truncate" style="max-width: 150px">{{$post->content}}</td>
                        <td>
                            @if($post->published)
                                <span class="badge badge-success">public</span>
                            @else
                                <span class="badge badge-warning">private</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.posts.show', $post->id)}}" class="btn btn-primary">View</a>
                            <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-warning">Edit</a>
                            <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>

    
@endsection