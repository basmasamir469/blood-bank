@extends('layouts.app')
@section('page-title')
<h1>Clients</h1>
@endsection
@section('small-title')
Clients
@endsection
@section('content')
@include('flash::message')
<form action="{{route('clients.search')}}" method="get">
  <div class="row">
  <div class="input-group w-50 col-3">
  <input type="search" class="form-control form-control" name="search" placeholder="search">
</div>
<div class=" form-group col-3">
    <select id="defaultSelect" name="blood_type" class="form-control">
        <option value="">choose blood_type</option>
        @foreach ($blood_types as $blood_type)
        <option value="{{$blood_type->id}}">{{$blood_type->name}}</option>
        @endforeach
    </select>
  </div>

  <div class=" form-group col-3">
    <select id="defaultSelect" name="governorate_id" class="form-control">
        <option value="">choose governorate</option>
        @foreach ($governorates as $governorate)
        <option value="{{$governorate->id}}">{{$governorate->name}}</option>
        @endforeach
    </select>
  </div>


  <div class="input-group-md ">
    <button type="submit" class="btn btn-default">
    <i class="fa fa-search"></i>
    </button>
    </div>  

  </div>

  </form>
  <div class="card">
  @if(count($clients)>0)
  <div class="card-body">
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th>Email </th>
        <th>Phone </th>
        <th>Blood Type </th>
        <th>Active </th>
        <th colspan="2">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($clients as $client )
      <tr>
        <th scope="row">{{$client->id}}</th>
        <td>{{$client->name}}</td>
        <td>{{$client->email}}</td>
        <td>{{$client->phone}}</td>
        <td style="color: red;font-weight:bold">{{$client->bloodType->name}}</td>
        <td><!-- Default switch -->
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input toggle-class" data-id="{{$client->id}}" @if ($client->active=='Active') checked @else  @endif id="{{'customSwitches'.$client->id}}">
            <label class="custom-control-label" for="{{'customSwitches'.$client->id}}">Activate</label>
          </div></td>
        <td><a href="{{route('clients.show',$client->id)}}" class="btn btn-primary">Show</a></td>
          <td>
          <form method="post" action="{{ route('clients.destroy',$client->id) }}"> 
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
  {!! $clients->render() !!}
@endsection
@push('scripts')
<script type="text/javascript">
  $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/admin/changestatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              console.log(data.status)
            }
        });
    })
  })
</script>

@endpush