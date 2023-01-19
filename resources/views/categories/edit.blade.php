@extends('layouts.app')
@section('small-title')
 edit category
@endsection

@section('content')
<div class="card card-secondary">
    <div class="card-header">
    <h3 class="card-title">Edit Category</h3>
    <div class="card-tools">
    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
    <i class="fas fa-minus"></i>
    </button>
    </div>
    </div>
    <div class="card-body">
        <form action="{{route('categories.update',$category->id)}}" method='Post'>
          @csrf
          @method('PATCH')
    <div class="form-group">
    <label for="inputEstimatedBudget">Name</label>
    <input type="text" name="name" value="{{$category->name}}" id="inputEstimatedBudget" class="form-control">
    @error('name')
    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
    @enderror
    <input type="hidden" name="id" value="{{$category->id}}" id="inputEstimatedBudget" class="form-control">
    </div>
    <input type="submit" value="update category" class="btn btn-success float-right">
  </form>

    </div>
    
    </div>
@endsection