@extends('layouts.app')
@section('small-title')
  change password
@endsection
@section('content')
@include('flash::message')
<div class="card card-secondary">
    <div class="card-header">
    <h3 class="card-title">Change Password</h3>
    <div class="card-tools">
    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
    <i class="fas fa-minus"></i>
    </button>
    </div>
    </div>
    <div class="card-body">
        <form action="{{route('update_password')}}" method='Post'>
          @csrf
          @method('PATCH')
    <div class="form-group">
    <label for="old">Old Password</label>
    <input type="password" name="old_password" id="old" class="form-control">
    @error('old_password')
    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
    @enderror
    </div>
    <div class="form-group">
      <label for="new">New Password</label>
      <input class="form-control" id="new" name="new_password" type="password">
      @error('new_password')
      <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
      @enderror  
      </div>  

      <div class="mb-3">
        <label for="formFile" class="form-label">Confirm New Password</label>
        <input class="form-control" name="new_password_confirmation" type="password" id="formFile">
        @error('new_password_confirmation')
        <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
        @enderror    
      </div>      
    <input type="submit" value="Update Password" class="btn btn-success float-right">
  </form>

    </div>
    
    </div>
@endsection