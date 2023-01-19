@extends('layouts.app')
@section('page-title')
Contact Details    
@endsection
@section('small-title')
 contact details
@endsection

@section('content')
<div class="col-8 d-flex align-items-stretch flex-column">
    <div class="card bg-light d-flex flex-fill">
    <div class="card-header text-muted border-bottom-0">
        {{$contact->name}}    </div>
    <div class="card-body pt-0">
    <div class="row">
    <div class="col-7">
    <h2 class="lead"><b>{{$contact->email}}</b></h2>
    <p class="text-muted text-sm"><b>About: </b> {{$contact->subject}} </p>
    <ul class="ml-4 mb-0 fa-ul text-muted">
    <li class="small mb-3"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> {{$contact->message}}</li>
    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: {{$contact->phone}}</li>
    </ul>
    </div>
    </div>
    </div>
    {{-- <div class="card-footer">
    <div class="text-right">
    <a href="#" class="btn btn-sm bg-teal">
    <i class="fas fa-comments"></i>
    </a>
    <a href="#" class="btn btn-sm btn-primary">
    <i class="fas fa-user"></i> View Profile
    </a>
    </div>
    </div> --}}
    </div>
    </div>
@endsection