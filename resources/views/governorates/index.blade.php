@extends('layouts.app')
@section('page-title')
<h1>Governorates</h1>
@endsection
@section('small-title')
  governorates
@endsection
@section('content')
@include('flash::message')
<div class="card">
@if(count($governorates)>0)
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
        @foreach ($governorates as $governorate )
      <tr>
        <th scope="row">{{$governorate->id}}</th>
        <td>{{$governorate->name}}</td>
        <td><a href="{{route('governorates.edit',$governorate->id)}}" class="btn btn-warning">Edit</a></td>
          <td>
          <form method="post" action="{{ route('governorates.destroy',$governorate->id) }}"> 
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
  {!! $governorates->render()!!}
@endsection