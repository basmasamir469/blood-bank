@extends('layouts.app')
@section('page-title')
<h1>Contacts</h1>
@endsection
@section('small-title')
Contacts
@endsection
@section('content')
@include('flash::message')
<form action="{{route('contacts.search')}}" method="get">
  <div class="input-group w-50 mb-3">
  <input type="search" class="form-control form-control" name="search" placeholder="search">
  <div class="input-group-append ">
    <button type="submit" class="btn btn-default">
    <i class="fa fa-search"></i>
    </button>
    </div>  

</div>
  </form>
  <div class="card">
  @if(count($contacts)>0)
  <div class="card-body">
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th>Email </th>
        <th>Phone </th>
        <th>Subject</th>
        <th colspan="2">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($contacts as $contact )
      <tr>
        <th scope="row">{{$contact->id}}</th>
        <td>{{$contact->name}}</td>
        <td>{{$contact->email}}</td>
        <td>{{$contact->phone}}</td>
        <td>{{$contact->subject}}</td>
        <td><a href="{{route('contacts.show',$contact->id)}}" class="btn btn-primary">Show</a></td>
          <td>
          <form method="post" action="{{ route('contacts.destroy',$contact->id) }}"> 
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
  {!! $contacts->render() !!}
@endsection
