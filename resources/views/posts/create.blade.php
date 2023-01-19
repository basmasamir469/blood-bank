@extends('layouts.app')
@section('small-title')
 add post 
@endsection

@section('content')
<div class="card card-secondary">
    <div class="card-header">
    <h3 class="card-title">Add Post</h3>
    <div class="card-tools">
    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
    <i class="fas fa-minus"></i>
    </button>
    </div>
    </div>
    <div class="card-body">
        <form action="{{route('posts.store')}}" method='Post' enctype="multipart/form-data">
          @csrf
    <div class="form-group">
    <label for="inputEstimatedBudget">Post Title</label>
    <input type="text" name="title" id="inputEstimatedBudget" class="form-control">
    @error('title')
    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
    @enderror
    </div>
    <div class="form-group">
      <label for="inputEstimatedBudget">Post Content</label>
      <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
      @error('content')
      <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
      @enderror  
      </div>  

      <div class="mb-3">
        <label for="formFile" class="form-label">Image</label>
        <input class="form-control" name="image" type="file" id="formFile">
        @error('image')
        <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
        @enderror    
      </div>
      
    <div class="form-group">
    <label for="gov-select"> Category Name</label>
    <select class="form-select-lg d-flex w-25" name="category_id" id="gov-select" aria-label="Default select example">
      <option selected value="">Open this select menu</option>
      @foreach ( $categories as $category )
      <option value="{{$category->id}}">{{$category->name}}</option>
      @endforeach
    </select>
    @error('category_id')
    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
    @enderror
    </div>

    <input type="submit" value="add post" class="btn btn-success float-right">
  </form>

    </div>
    
    </div>
@endsection