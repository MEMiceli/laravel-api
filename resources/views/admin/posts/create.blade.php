@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Crea post</h1>
            </div>
            <div class="card-body">
                <form action="{{route('admin.posts.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Titolo</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')}}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Contenuto</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" cols="30" rows="10">{{old('content')}}</textarea>
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" name="category_id" id="category" >
                            <option value="">Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}"{{old('category_id') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>  
                            @endforeach
                        </select>    
                    </div>
                    <div class="form-group">
                        <h6>Tags</h6>
                       @foreach ($tags as $tag)
                       <div class="form-check form-check-inline">
                           <input class="form-check-input" type="checkbox" id="{{$tag->slug}}" value="{{$tag->id}}" name="tags[]" {{in_array($tag->id, old('tags', [])) ? 'checked' : ''}}>
                           <label for="form-check-label" for="{{$tag->slug}}">{{$tag->name}}</label>
                       </div>
                       @endforeach 
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input @error('published') is-invalid @enderror" id="published" name="published">
                        <label class="form-check-label" for="published" value="{{old('published') ? 'checked' : ''}}">Pubblica</label>
                        @error('published')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Crea</button>
                </form>

            </div>
        </div>
    </div>
    
@endsection