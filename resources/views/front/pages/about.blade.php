@extends('front.master',['class'=>'who-are-us','home'=>'','about'=>'','aboutus'=>'active','contactus'=>'','donations'=>'','posts'=>''])
@section('content')
<div class="about-us">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front-home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">من نحن</li>
                </ol>
            </nav>
        </div>
        <div class="details">
            <div class="logo">
                <img src="{{asset('front/imgs/logo.png')}}">
            </div>
            <div class="text">
                 <p>
                    {{$settings->about_app}}
                </p>
                <p>
                    {{$settings->about_app}}
                </p> 
                <p>
                    {{$settings->about_app}}
                </p>
            </div>
        </div>
    </div>
</div>


@endsection
