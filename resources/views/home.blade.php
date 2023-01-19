@extends('layouts.app')
@inject('client','App\Models\Client' )
@inject('donation_request','App\Models\DonationRequest' )
@inject('governorate','App\Models\Governorate' )
@inject('contact','App\Models\Contact' )
@inject('city','App\Models\City' )
@inject('post','App\Models\Post' )
@inject('category','App\Models\Category' )
@inject('user','App\Models\User' )

@section('page-title')
<h1>Statistics</h1>
@endsection
@section('small-title')
Statistics
@endsection
@section('content')
<!-- Main content -->

  <!-- Default box -->
  {{-- <div class="card">
    <div class="card-header">
      <h3 class="card-title">Title</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      Start creating your amazing application!
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      Footer
    </div>
    <!-- /.card-footer-->
  </div> --}}
  <!-- /.card -->
<div class="row">
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Clients</span>
        <span class="info-box-number">{{$client->count()}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-success"><i class="far fa-envelope"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Donation Requests</span>
        <span class="info-box-number">{{$donation_request->count()}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-warning"><i class="fas fa-building"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Governorates</span>
        <span class="info-box-number">{{$governorate->count()}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-secondary"><i class="fas fa-city"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Cities</span>
        <span class="info-box-number">{{$city->count()}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-secondary"><i class="far fa-envelope"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Contacts</span>
        <span class="info-box-number">{{$contact->count()}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-dark"><i class="fas fa-bars"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Categories</span>
        <span class="info-box-number">{{$category->count()}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="far fa-comment"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Posts</span>
        <span class="info-box-number">{{$post->count()}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-primary"><i class="far fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Users</span>
        <span class="info-box-number">{{$user->count()}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>

</section>
@endsection