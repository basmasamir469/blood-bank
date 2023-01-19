@extends('layouts.app')
@section('page-title')
Donation Request Details    
@endsection
@section('small-title')
Donation Request Details    
@endsection
@section('content')
<div class="col-8">

    <div class="card card-primary card-outline">
    <div class="card-body box-profile">
    <h3 class="profile-username text-center">{{$donation_request->patient_name}} </h3>
    <p class="text-muted text-center">{{$donation_request->patient_phone}}</p>
    <ul class="list-group list-group-unbordered mb-3">
    <li class="list-group-item">
    <b>Age</b> <a class="float-right">{{$donation_request->patient_age}}</a>
    </li>
    <li class="list-group-item">
    <b>City</b> <a class="float-right">{{$donation_request->city->name}}</a>
    </li>
    <li class="list-group-item">
    <b>Governorate</b> <a class="float-right">{{$donation_request->city->governorate->name}}</a>
    </li>    
    <li class="list-group-item">
    <b>Blood Type</b> <a class="float-right">{{$donation_request->bloodType->name}}</a>
    </li>
    </ul>
    </div>
    
    </div>
    
    
    <div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title">Request Details</h3>
    </div>
    
    <div class="card-body">
    <strong><i class="fas fa-hospital mr-1"></i>Hospital</strong>
    <p class="text-muted">
        {{$donation_request->hospital_name}}
    </p>
    <hr>
    <strong><i class="fas fa-map-marker-alt mr-1"></i> Hospital Address</strong>
    <p class="text-muted">{{$donation_request->hospital_address}}
    </p>
    <hr>
    <strong><i class="fas fa-briefcase mr-1"></i> Bags Number</strong>
    <p class="text-muted">
    <span class="tag tag-primary">{{$donation_request->bags_num}}</span>
    </p>
    <hr>
    <strong><i class="far fa-file-alt mr-1"></i> Details</strong>
    <p class="text-muted">{{$donation_request->details}}</p>
    </div>
    
    </div>
    
    </div>
@endsection