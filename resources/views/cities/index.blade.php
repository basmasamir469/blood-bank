@extends('layouts.app')
@section('page-title')
<h1>Cities</h1>
@endsection
@section('small-title')
 cities
@endsection

@section('content')
<div class="card">
@if(count($cities)>0)
@include('flash::message')
<div class="card-body">
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">City Name</th>
        <th>Governorate Name </th>
        <th colspan="2">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($cities as $city )
      <tr>
        <th scope="row">{{$city->id}}</th>
        <td>{{$city->name}}</td>
        <td>{{$city->governorate->name??''}}</td>
        <td><a href="{{route('cities.edit',$city->id)}}" class="btn btn-warning">Edit</a></td>
          <td>
          <form method="post" action="{{ route('cities.destroy',$city->id) }}"> 
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
  {!! $cities->render() !!}
@endsection