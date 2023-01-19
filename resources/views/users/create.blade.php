@extends('layouts.app')
@section('small-title')
 add user
@endsection

@section('content')
<div class="card card-secondary">
    <div class="card-header">
    <h3 class="card-title">Add User</h3>
    <div class="card-tools">
    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
    <i class="fas fa-minus"></i>
    </button>
    </div>
    </div>
    <div class="card-body">
        <form action="{{route('users.store')}}" method='Post' enctype="multipart/form-data">
          @csrf
    <div class="form-group">
    <label for="inputEstimatedBudget">Name</label>
    <input type="text" name="name" id="inputEstimatedBudget" class="form-control">
    @error('name')
    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
    @enderror
    </div>
    <div class="form-group">
      <label for="inputEstimatedBudget">Email</label>
      <input class="form-control" name="email" type="email">
      @error('email')
      <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
      @enderror  
      </div>  

      <div class="mb-3">
        <label for="formFile" class="form-label">Password</label>
        <input class="form-control" name="password" type="password" id="formFile">
        @error('password')
        <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
        @enderror    
      </div>

      <div class="mb-3">
        <label for="formFile" class="form-label">Confirm Password</label>
        <input class="form-control" name="confirm-password" type="password" id="formFile">
        @error('password_confirmation')
        <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
        @enderror    
      </div>
      <div class="form-group">
        <label class="form-label d-block">Choose Roles</label>
        @foreach ($roles as $role )
        <div class="form-check">
        <input class="form-check-input" type="checkbox" name="roles[]" value="{{$role->id}}" id="defaultCheck2">
        <label class="form-check-label" for="defaultCheck2">    {{$role->name}}    </label>
      </div>
         @endforeach
          @error('roles')
          <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
          @enderror    
      </div>

      
    <input type="submit" value="add user" class="btn btn-success float-right">
  </form>

    </div>
    
    </div>
@endsection