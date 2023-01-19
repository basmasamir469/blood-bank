@extends('front.master',['class'=>'signin-account','home'=>'','about'=>'','aboutus'=>'','contactus'=>'','donations'=>'','posts'=>''])
@section('content')
{{-- <div class="upper-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="language">
                    <a href="signin-account.html" class="ar active">عربى</a>
                    <a href="signin-account-rtl.html" class="en inactive">EN</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="social">
                    <div class="icons">
                        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="accounts" dir="ltr">
                    <a href="signin-account.html" class="signin">الدخول</a>
                    <a href="create-account.html" class="create-new">إنشاء حساب جديد</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}


<!--nav-->
{{-- <div class="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="imgs/logo.png" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">عن بنك الدم</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">المقالات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="donation-requests.html">طلبات التبرع</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="who-are-us.html">من نحن</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact-us.html">اتصل بنا</a>
                    </li>
                </ul>
                <a href="#" class="donate">
                    <img src="imgs/transfusion.svg">
                    <p>طلب تبرع</p>
                </a>
            </div>
        </div>
    </nav>
</div> --}}

<!--form-->
<div class="form">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front-home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
                </ol>
            </nav>
        </div>
        <div class="signin-form">
            <form method="post" action="{{route('front-login')}}">
                @csrf
                <div class="logo">
                    <img src="{{asset('front/imgs/logo.png')}}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="phone" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الجوال">
                </div>
                @error('phone')
                <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                @enderror

                <div class="form-group">
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="كلمة المرور">
                </div>
                @error('password')
                <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                @enderror

                <div class="row options">
                    <div class="col-md-6 remember">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">تذكرنى</label>
                        </div>
                    </div>
                    <div class="col-md-6 forgot">
                        <img src="{{asset('front/imgs/complain.png')}}">
                        <a href="{{route('forget-password')}}">هل نسيت كلمة المرور</a>
                    </div>
                </div>
                <div class="row buttons">
                    <div class="col-md-6 right">
                        <button class="btn btn-success" type="submit">دخول</button>
                    </div>
                    <div class="col-md-6 left">
                        <a href="{{route('register')}}">انشاء حساب جديد</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
        
