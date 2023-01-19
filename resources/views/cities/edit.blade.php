@extends('layouts.app')
@section('small-title')
 edit city
@endsection
@section('content')
<div class="card card-secondary">
    <div class="card-header">
    <h3 class="card-title">Edit City</h3>
    <div class="card-tools">
    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
    <i class="fas fa-minus"></i>
    </button>
    </div>
    </div>
    <div class="card-body">
        <form action="{{route('cities.update',$city->id)}}" method='Post'>
          @csrf
          @method('PATCH')
    <div class="form-group">
    <label for="inputEstimatedBudget">Name</label>
    <input type="text" name="name" value="{{$city->name}}" id="inputEstimatedBudget" class="form-control">
    @error('name')
    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
    @enderror
    </div>
    <div class="form-group">
      <label for="gov-select"> Governorate Name</label>
      <select class="form-select-lg d-flex w-25" name="governorate_id" id="gov-select" aria-label="Default select example">
        {{-- <option selected value="">Open this select menu</option> --}}
        @foreach ( $governorates as $governorate )
        <option value="{{$governorate->id}}" @if($city->governorate_id==$governorate->id)selected @endif>{{$governorate->name}}</option>
        @endforeach
      </select>
      @error('governorate_id')
      <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
      @enderror  
      </div>
  
    <input type="submit" value="edit city" class="btn btn-success float-right">
  </form>

    </div>
    
    </div>
@endsection