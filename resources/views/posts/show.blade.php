@extends('layouts.app')
@section('small-title')
 post details 
@endsection

@section('content')
<div class="card text-center">
    <div class="card-header">
        Post Details
    </div>
    <div class="card-image mt-3">
        <img src="{{url('images/posts/'.$post->image)}}" width="70%" height="300px" alt="error">
      </div>  
    <div class="card-body">
      <h5 class=" d-flex justify-content-center">{{$post->title}}</h5>
      <p class="card-text">{{$post->content}}</p>
      <a href="{{route('posts.index')}}" class="btn btn-primary">Go back</a>
    </div>
    <div class="card-footer text-muted">
       created at {{$post->created_at->toDateString('y-m-d')}}
    </div>
  </div>
@endsection