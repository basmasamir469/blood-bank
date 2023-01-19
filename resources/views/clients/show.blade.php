@extends('layouts.app')
@section('page-title')
Client Details    
@endsection
@section('small-title')
Client Details    
@endsection
@section('content')
<div class="col-8">

    <div class="card card-primary card-outline">
    <div class="card-body box-profile">
    <h3 class="profile-username text-center">{{$client->name}} 
      @if ($client->active=='Active')
      <span class=" badge badge-success">{{$client->active}}</span>
      @else
      <span class=" badge badge-secondary">{{$client->active}}</span>
      @endif
   </h3>
    <ul class="list-group list-group-unbordered mb-3">
      <li class="list-group-item">
        <b>Email</b> <a class="float-right">{{$client->email}}</a>
      </li>    
      <li class="list-group-item">
      <b>City</b> <a class="float-right">{{$client->city->name}}</a>
      </li>
      <li class="list-group-item">
      <b>Governorate</b> <a class="float-right">{{$client->city->governorate->name}}</a>
      </li>
      <li class="list-group-item">
      <b>Blood Type</b> <a class="float-right">{{$client->bloodType->name}}</a>
      </li>
      </ul>
  
    </div>
    
    </div>
    
    
@endsection