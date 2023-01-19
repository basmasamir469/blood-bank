@extends('front.master',['class'=>'signin-account','home'=>'','about'=>'','aboutus'=>'','contactus'=>'','donations'=>'','posts'=>''])
@section('content')
<!--form-->
<div class="form">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front-home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تغيير كلمة السر</li>
                </ol>
            </nav>
        </div>
        <div class="signin-form">
            <form method="post" action="{{route('confirm-password')}}">
                @csrf
                <div class="logo">
                    <img src="{{asset('front/imgs/logo.png')}}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="pin_code" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الكود">
                </div>
                @error('pin_code')
                <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                @enderror

                <div class="form-group">
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="كلمة المرور">
                </div>
                @error('password')
                <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                @enderror

                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2" placeholder="تأكيد كلمة المرور">
                </div>
                @error('password_confirmation')
                <small id="emailHelp" class="form-text font-weight-bold  text-danger">{{$message}}</small>
                @enderror



                <div class="row buttons">
                    <div class="col-md-6 right">
                        <button class="btn btn-success" type="submit">تغيير كلمة السر</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
        
