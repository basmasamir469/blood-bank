@extends('layouts.app')
@section('page-title')
User Details    
@endsection
@section('small-title')
User Details    
@endsection
@section('content')
<div class="col-8">

    <div class="card card-primary card-outline">
    <div class="card-body box-profile">
    <h3 class="profile-username text-center">{{$user->name}} </h3>
    <p class="text-muted text-center">{{$user->email}}</p>
    <ul class="list-group list-group-unbordered mb-3">
      @foreach ($user->roles as $role )
      <b> Roles</b>
      <li class="list-group-item">
       <a>{{$role->name}}</a>
      </li>
       <ul class="list-group list-group-unbordered">
       <b> Permissions</b>
        @foreach ($role->permissions as $permission)
        <li class="list-group-item">
          {{$permission->name}}
        </li>
        @endforeach
       </ul>
      @endforeach
    </ul>
    </div>
    
    </div>
    
    
@endsection