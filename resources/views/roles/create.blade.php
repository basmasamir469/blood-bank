@extends('layouts.app')
@section('page-title')
  <h1>Create Role</h1>  
@endsection
@section('small-title')
 Create Role  
@endsection
@section('content')
<div class="card">
<div class="card-body">

@if (count($errors) > 0)
<div class="alert alert-danger">
<strong>Whoops!</strong> There were some problems with your input.<br><br>
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group mb-3">
<strong>Name:</strong>
{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group mb-3">
<strong>Permission:</strong>
<br/>
<input type="checkbox" name=""  id="checkAll">
<label for="checkAll">Select All</label>
<br>
@foreach($permission as $value)
<label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
{{ $value->name }}</label>
<br/>
@endforeach
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 text-center">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>
{!! Form::close() !!}
</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>
@endpush
