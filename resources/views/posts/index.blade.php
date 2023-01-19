@extends('layouts.app')
@section('page-title')
<h1>Posts</h1>
@endsection
@section('small-title')
 posts
@endsection

@section('content')
@include('flash::message')
<div class="card">
  <div class="card-body">
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Post Title</th>
        <th>Category Name </th>
        <th colspan="2">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post )
      <tr>
        <th scope="row">{{$post->id}}</th>
        <td>{{$post->title}}</td>
        <td>{{$post->category->name??''}}</td>
        <td><a href="{{route('posts.edit',$post->id)}}" class="btn btn-warning">Edit</a></td>
        <td><a href="{{route('posts.show',$post->id)}}" class="btn btn-primary">Show</a></td>
          <td>
          <form method="post" action="{{ route('posts.destroy',$post->id) }}"> 
            @csrf       
            @method('DELETE')
        <input type="submit" class="btn btn-danger" value="Delete">
      </form>
         </td>
      </tr>
      @endforeach

    </tbody>
  </table>
</div>
  {!! $posts->render() !!}
</div>
@endsection