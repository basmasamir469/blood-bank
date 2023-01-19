@extends('layouts.app')
@section('page-title')
<h1>Categories</h1>
@endsection
@section('small-title')
 categories 
@endsection
@section('content')
<div class="card">
@include('flash::message')
@if(count($categories)>0)
<div class="card-body">
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th colspan="2">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category )
      <tr>
        <th scope="row">{{$category->id}}</th>
        <td>{{$category->name}}</td>
        <td><a href="{{route('categories.edit',$category->id)}}" class="btn btn-warning">Edit</a></td>
          <td>
          <form method="post" action="{{ route('categories.destroy',$category->id) }}"> 
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
  @else
  <div class="alert alert-danger" role="alert">
   No data
 </div>
 @endif
</div>
 {!! $categories->render()!!} 
@endsection