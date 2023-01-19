@extends('layouts.app')
@section('small-title')
 edit post
@endsection

@section('content')
<div class="card card-secondary">
    <div class="card-header">
    <h3 class="card-title">Edit Post</h3>
    <div class="card-tools">
    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
    <i class="fas fa-minus"></i>
    </button>
    </div>
    </div>
    <div class="card-body">
        <form action="{{route('posts.update',$post->id)}}" method='Post' enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="form-group">
            <label for="inputEstimatedBudget">Post Title</label>
            <input type="text" name="title" value="{{$post->title}}" id="inputEstimatedBudget" class="form-control">
            @error('title')
            <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
            @enderror        
            </div>
            <div class="form-group">
              <label for="inputEstimatedBudget">Post Content</label>
              <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3">{{$post->content}}
              </textarea>
              @error('content')
              <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
              @enderror          
              </div>  
        
              <div class="mb-3">
                <label for="formFile" class="form-label">Image</label>
                <input class="form-control" name="image"  type="file" id="formFile">
                @error('image')
                <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                @enderror            
                <img src="{{ url('images/posts/'.$post->image) }}" height="200px" width="200px">
              </div>
              
            <div class="form-group">
            <label for="gov-select"> Category Name</label>
            <select class="form-select-lg d-flex w-25" name="category_id" id="gov-select" aria-label="Default select example">
              @foreach ( $categories as $category )
              <option value="{{$category->id}}" @if($post->category_id==$category->id) selected @endif>{{$category->name}}</option>
              @endforeach
            </select>
            @error('category_id')
            <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
            @enderror        
            </div>
        
    <input type="submit" value="edit post" class="btn btn-success float-right">
  </form>

    </div>
    
    </div>
@endsection