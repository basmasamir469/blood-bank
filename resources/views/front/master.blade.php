<!doctype html>
<html lang="en" dir="rtl">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
        
        <!--google fonts css-->
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
        
        <!--font awesome css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
        <link rel="icon" href="{{asset('front/imgs/Icon.png')}}">
        
        <!--owl-carousel css-->
        <link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('front/css/owl.theme.default.min.css')}}">
        
        <!--style css-->
        <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
        
        <title>Blood Bank</title>
    </head>
    <body class="{{$class}}">
        <!--upper-bar-->
        <div class="upper-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="language">
                            <a href="index.html" class="ar active">عربى</a>
                            <a href="index-ltr.html" class="en inactive">EN</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="social">
                            <div class="icons">
                                <a href="{{$settings->fb_link}}" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{$settings->insta_link}}" class="instagram"><i class="fab fa-instagram"></i></a>
                                <a href="{{$settings->tw_link}}" class="twitter"><i class="fab fa-twitter"></i></a>
                                <a href="{{$settings->phone}}" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- not a member-->
                    <div class="col-lg-5">
                        
                        <!--I'm a member -->
                  @auth('front')
                      
                        <div class="member">
                            <p class="welcome">مرحباً بك</p>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{auth('front')->user()->name}}
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('front-home')}}">
                                        <i class="fas fa-home"></i>
                                        الرئيسية
                                    </a>
                                    <a class="dropdown-item" href="{{route('myprofile')}}">
                                        <i class="far fa-user"></i>
                                        معلوماتى
                                    </a>
                                    <a class="dropdown-item" href="{{route('notification-settings')}}">
                                        <i class="far fa-bell"></i>
                                        اعدادات الاشعارات
                                    </a>
                                    <a class="dropdown-item" href="{{url('/favouriteposts')}}">
                                        <i class="far fa-heart"></i>
                                        المفضلة
                                    </a>
                                    <a class="dropdown-item" href="{{route('contact-us')}}">
                                        <i class="fas fa-phone-alt"></i>
                                        تواصل معنا
                                    </a>
                                    <a class="dropdown-item" href="{{route('front-logout')}}">
                                        <i class="fas fa-sign-out-alt"></i>
                                        تسجيل الخروج
                                    </a>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="info" dir="ltr">
                            <div class="phone">
                                <i class="fas fa-phone-alt"></i>
                                <p>{{$settings->phone}}</p>
                            </div>
                            <div class="e-mail">
                                <i class="far fa-envelope"></i>
                                <p>{{$settings->email}}</p>
                            </div>
                        </div>

                        @endauth
                        
                    </div>
                </div>
            </div>
        </div>
        
        
        <!--nav-->
        <div class="nav-bar">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand" href="{{route('front-home')}}">
                        <img src="{{asset('front/imgs/logo.png')}}" class="d-inline-block align-top" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item {{$home}}">
                                <a class="nav-link" href="{{route('front-home')}}">الرئيسية <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item {{$about}}">
                                <a class="nav-link" href="{{route('about-us')}}">عن بنك الدم</a>
                            </li>
                            <li class="nav-item {{$posts}}">
                                <a class="nav-link" href="{{route('posts')}}">المقالات</a>
                            </li>
                            <li class="nav-item {{$donations}}">
                                <a class="nav-link" href="{{route('donation_requests')}}">طلبات التبرع</a>
                            </li>
                            <li class="nav-item {{$aboutus}}">
                                <a class="nav-link" href="{{route('about-us')}}">من نحن</a>
                            </li>
                            <li class="nav-item {{$contactus}}">
                                <a class="nav-link" href="{{route('contact-us')}}">اتصل بنا</a>
                            </li>
                        </ul>
                        
                        @auth("front")
                                                <!--I'm a member -->

                        <a href="{{route('create-request')}}" class="donate">
                            <img src="{{asset('front/imgs/transfusion.svg')}}">
                            <p>طلب تبرع</p>
                        </a>
                         @else
                        <div class="accounts">
                            <a href="{{route('register')}}" class="create">إنشاء حساب جديد</a>
                            <a href="{{route('signin')}}" class="signin">الدخول</a>
                        </div>
                        @endauth
                        
                        
                    </div>
                </div>
            </nav>
        </div>
        @include('flash::message')

        @yield('content')
        
        <!--footer-->
        <div class="footer">
            <div class="inside-footer">
                <div class="container">
                    <div class="row">
                        <div class="details col-md-4">
                            <img src="{{asset('front/imgs/logo.png')}}">
                            <h4>بنك الدم</h4>
                            <p>
                                {{$settings->conclusion}}
                            </p>
                        </div>
                        <div class="pages col-md-4">
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" id="list-home-list" href="{{route('front-home')}}" role="tab" aria-controls="home">الرئيسية</a>
                                <a class="list-group-item list-group-item-action" id="list-profile-list" href="{{route('about-us')}}" role="tab" aria-controls="profile">عن بنك الدم</a>
                                <a class="list-group-item list-group-item-action" id="list-messages-list" href="{{route('posts')}}" role="tab" aria-controls="messages">المقالات</a>
                                <a class="list-group-item list-group-item-action" id="list-settings-list" href="{{route('donation_requests')}}" role="tab" aria-controls="settings">طلبات التبرع</a>
                                <a class="list-group-item list-group-item-action" id="list-settings-list" href="{{route('about-us')}}" role="tab" aria-controls="settings">من نحن</a>
                                <a class="list-group-item list-group-item-action" id="list-settings-list" href="{{route('contact-us')}}" role="tab" aria-controls="settings">اتصل بنا</a>
                            </div>
                        </div>
                        <div class="stores col-md-4">
                            <div class="availabe">
                                <p>متوفر على</p>
                                <a href="#">
                                    <img src="{{asset('front/imgs/google1.png')}}">
                                </a>
                                <a href="#">
                                    <img src="{{asset('front/imgs/ios1.png')}}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="other">
                <div class="container">
                    <div class="row">
                        <div class="social col-md-4">
                            <div class="icons">
                                <a href="{{$settings->fb_link}}" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{$settings->insta_link}}" class="instagram"><i class="fab fa-instagram"></i></a>
                                <a href="{{$settings->tw_link}}" class="twitter"><i class="fab fa-twitter"></i></a>
                                <a href="{{$settings->phone}}" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                        <div class="rights col-md-8">
                            <p>جميع الحقوق محفوظة لـ <span>بنك الدم</span> &copy; 2019</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <script src="{{asset('front/js/bootstrap.bundle.js')}}"></script>
        <script src="{{asset('front/js/bootstrap.bundle.min.js')}}"></script>
      
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js" integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k" crossorigin="anonymous"></script>
        
        <script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
        
        <script src="{{asset('front/js/main.js')}}"></script>
        @stack('scripts')

    </body>
</html>