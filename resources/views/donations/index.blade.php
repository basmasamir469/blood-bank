@extends('layouts.app')
@section('page-title')
<h1>Donation Requests</h1>
@endsection
@section('small-title')
donation requests
@endsection
@section('content')
@include('flash::message')
<form action="{{route('donations.search')}}" method="get">
  <div class="row">
  <div class="input-group w-50 col-3">
  <input type="search" class="form-control form-control" name="search" placeholder="search">
</div>
<div class=" form-group col-3">
    <select id="defaultSelect" name="blood_type" class="form-control">
        <option value="">choose blood_type</option>
        @foreach ($blood_types as $blood_type)
        <option value="{{$blood_type->id}}">{{$blood_type->name}}</option>
        @endforeach
    </select>
  </div>
  <div class=" form-group col-3">
    <select id="defaultSelect" name="governorate_id" class="form-control">
        <option value="">choose governorate</option>
        @foreach ($governorates as $governorate)
        <option value="{{$governorate->id}}">{{$governorate->name}}</option>
        @endforeach
    </select>
  </div>

  <div class="input-group-md ">
    <button type="submit" class="btn btn-default">
    <i class="fa fa-search"></i>
    </button>
    </div>  

  </div>

  </form>
  <div class="card">
  @if(count($donation_requests)>0)
  <div class="card-body">
<table class="table table-striped">
    <thead>
      <tr>  
        <th scope="col">#</th>
        <th scope="col">Patient Name</th>
        <th>Patient Phone </th>
        <th>Patient Age</th>
        <th>Patient City</th>
        <th>Blood Type </th>
        <th>Bags Number</th>
        <th colspan="2">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($donation_requests as $donation_request )
      <tr>
        <th scope="row">{{$donation_request->id}}</th>
        <td>{{$donation_request->patient_name}}</td>
        <td>{{$donation_request->patient_phone}}</td>
        <td>{{$donation_request->patient_age}}</td>
        <td>{{$donation_request->city->name}}</td>
        <td>{{$donation_request->bloodType->name}}</td>
        <td>{{$donation_request->bags_num}}</td>
        <td><a href="{{route('donations.show',$donation_request->id)}}" class="btn btn-primary">Show</a></td>
          <td>
          <form method="post" action="{{ route('donations.destroy',$donation_request->id) }}"> 
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
  {!! $donation_requests->render() !!}
@endsection
