@extends('front.master',['class'=>'','home'=>'active','about'=>'','aboutus'=>'','contactus'=>'','donations'=>'','posts'=>''])
@section('content')
         <!--intro-->
         <div class="intro">
            <div id="slider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slider" data-slide-to="0" class="active"></li>
                    <li data-target="#slider" data-slide-to="1"></li>
                    <li data-target="#slider" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item carousel-1 active">
                        <div class="container info">
                            <div class="col-lg-5">
                                <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                                <p>
                                    {{$settings->intro}}
                                </p>
                                <a href="{{route('about-us')}}">المزيد</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item carousel-2">
                        <div class="container info">
                            <div class="col-lg-5">
                                <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                                <p>
                                    {{$settings->intro}}
                                </p>
                                <a href="{{route('about-us')}}">المزيد</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item carousel-3">
                        <div class="container info">
                            <div class="col-lg-5">
                                <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                                <p>
                                    {{$settings->intro}}
                                </p>
                                <a href="{{route('about-us')}}">المزيد</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--about-->
        <div class="about">
            <div class="container">
                <div class="col-lg-6 text-center">
                    <p>
                        <span>بنك الدم</span>
                        {{$settings->intro}}
                    </p>
                </div>
            </div>
        </div>
        
        <!--articles-->
        <div class="articles">
            <div class="container title">
                <div class="head-text">
                    <h2>المقالات</h2>
                </div>
            </div>
            <div class="view">
                <div class="container">
                    <div class="row">
                        <!-- Set up your HTML -->
                        <div class="owl-carousel articles-carousel">
                            @foreach ($posts as $post)
                                
                            <div class="card">
                                <div class="photo">
                                    <img src="{{url('images/posts/'.$post->image)}}" class="card-img-top" alt="...">
                                    <a href="{{route('post-details',$post->id)}}" class="click">المزيد</a>
                                </div>
                                <a href="" class="favourite">
                                    <i class="far fa-heart {{(auth('front')->user() && auth('front')->user()->favPosts()->find($post->id))? 'fav':'' }}" onclick="toggle(this,event)" data-id="{{$post->id}}"></i>
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{$post->title}}</h5>
                                    <p class="card-text">
                                        {{$post->content}}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--requests-->
        <div class="requests">
            <div class="container">
                <div class="head-text">
                    <h2>طلبات التبرع</h2>
                </div>
            </div>
            <div class="content">
                <div class="container">
                    <form class="row filter" id="myform" method="post">
                        @csrf
                        <div class="col-md-5 blood">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select class="form-control" name="blood_type_id" id="exampleFormControlSelect1">
                                        <option selected value="" disabled>اختر فصيلة الدم</option>
                                        @foreach ( $blood_types as $blood_type )
                                    <option value={{$blood_type->id}}>{{$blood_type->name}}</option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 city">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select class="form-control" name="city_id" id="exampleFormControlSelect1">
                                        <option selected value="" disabled>اختر المدينة</option>
                                        @foreach ($cities as $city)
                                        <option value={{$city->id}}>{{$city->name}}</option>
                                        @endforeach

                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 search">
                            <button id="btn" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="patients">
                        @foreach ($donation_requests as $donation_request )
                         <div class="details">
                            <div class="blood-type">
                                <h2 dir="ltr">{{$donation_request->bloodType->name}}</h2>
                            </div>
                            <ul>
                                <li><span>اسم الحالة:</span> {{$donation_request->patient_name}}</li>
                                <li><span>مستشفى:</span> {{$donation_request->hospital_name}}</li>
                                <li><span>المدينة:</span> {{$donation_request->city->name}}</li>
                            </ul>
                            <a href="{{route('donation-details',$donation_request->id)}}">التفاصيل</a>
                        </div>
                        @endforeach
                    </div>
                    <div class="more">
                        <a href="{{route('donation_requests')}}">المزيد</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!--contact-->
        <div class="contact">
            <div class="container">
                <div class="col-md-7">
                    <div class="title">
                        <h3>اتصل بنا</h3>
                    </div>
                    <p class="text">يمكنك الإتصال بنا للإستفسار عن معلومة وسيتم الرد عليكم</p>
                    <div class="row whatsapp">
                        <a href="#">
                            <img src="{{asset('front/imgs/whats.png')}}">
                            <p dir="ltr">+002 {{$settings->phone}}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!--app-->
        <div class="app">
            <div class="container">
                <div class="row">
                    <div class="info col-md-6">
                        <h3>تطبيق بنك الدم</h3>
                        <p>
                            {{$settings->conclusion}}
                        </p>
                        <div class="download">
                            <h4>متوفر على</h4>
                            <div class="row stores">
                                <div class="col-sm-6">
                                    <a href="#">
                                        <img src="{{asset('front/imgs/google.png')}}">
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="#">
                                        <img src="{{asset('front/imgs/ios.png')}}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="screens col-md-6">
                        <img src="{{asset('front/imgs/App.png')}}">
                    </div>
                </div>
            </div>
        </div>
   
@endsection
@push('scripts')
<script type="text/javascript">
  $(function() {
    $('#btn').click(function(e) {
        e.preventDefault()
        var formData = new FormData($('#myform')[0]);
         $.ajax({
            type: "POST",
            enctype:"multipart/form-data",
            dataType: "json",
            url: '/searchdonations',
            data:formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data){
                if(data.status==1){
                    $('.patients').empty()
               let donations=data.data
               for(let donation of donations){
             $('.patients').append('<div class="details"><div class="blood-type"><h2 dir="ltr">'+donation.blood_type.name+'</h2></div><ul><li><span>اسم الحالة:</span>'+donation.patient_name+'</li><li><span>مستشفى:</span>'+donation.hospital_name+'</li><li><span>المدينة:</span>'+donation.city.name+'</li></ul><a href="inside-request.html">التفاصيل</a></div>')
              }
            }
            },
            error:function(){
                console.log('error')
            }
        });
    })
  })
  function toggle(heart,e) {
        e.preventDefault()
         $.ajax({
            type: "POST",
            enctype:"multipart/form-data",
            dataType: "json",
            url: "{{route('togglefav')}}",
            data: {
             "_token": "{{ csrf_token() }}",
              'post_id':$(heart).data('id')
              },
             success: function(data){
                if(data.status==1){
                    if(data.data.attached.length > 0){
                        $(heart).addClass('fav')
                        console.log('added')
                    }
                    else if(data.data.detached.length > 0){
                        $(heart).removeClass('fav')
                        console.log('removed')
                    }
            }
            },
            error:function(){
                console.log('error')
            }
        });
    }

</script>

@endpush