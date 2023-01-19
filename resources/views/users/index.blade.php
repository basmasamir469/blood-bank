@extends('layouts.app')
@section('page-title')
<h1>Users</h1>
@endsection
@section('small-title')
  users
@endsection
@section('content')
@include('flash::message')
<div class="card">
  <div class="card-header">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
        {{-- @can('role-create') --}}
        <a class="btn btn-success mb-3" href="{{ route('users.create') }}"> Create New User</a>
        {{-- @endcan --}}
        </div>
        </div>        
</div>
  <div class="card-body">
    @if(count($users)>0)
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th>Email </th>
          <th>Role </th>
          <th colspan="2">Actions</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($users as $user )
        <tr>
          <th scope="row">{{$user->id}}</th>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>@foreach ($user->roles as $role)
            <span class="badge badge-primary">{{$role->name}}</span>
              @endforeach
                      </td>
          <td><a href="{{route('users.show',$user->id)}}" class="btn btn-primary">Show</a></td>
          <td><a href="{{route('users.edit',$user->id)}}" class="btn btn-warning">Edit</a></td>
            <td>
            <form method="post" action="{{ route('users.destroy',$user->id) }}"> 
              @csrf       
              @method('DELETE')
          <input type="submit" class="btn btn-danger" value="Delete">
        </form>
           </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @else
    <div class="alert alert-danger" role="alert">
     No data
   </div>
   @endif
  </div>
  </div>
    {!! $users->render() !!}
  @endsection
  
