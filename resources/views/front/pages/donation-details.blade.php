@extends('front.master',['class'=>'inside-request','home'=>'','about'=>'','aboutus'=>'','contactus'=>'','donations'=>'active','posts'=>''])
@section('content')        

      <!--ask-donation-->
        <div class="ask-donation">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front-home')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{route('donation_requests')}}">طلبات التبرع</a></li>
                            <li class="breadcrumb-item active" aria-current="page">طلب التبرع:{{$donation->patient_name}}</li>
                        </ol>
                    </nav>
                </div>
                <div class="details">
                    <div class="person">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>الإسم</p>
                                        </div>
                                        <div class="light">
                                            <p>{{$donation->patient_name}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>فصيلة الدم</p>
                                        </div>
                                        <div class="light">
                                            <p dir="ltr">{{$donation->bloodType->name}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>العمر</p>
                                        </div>
                                        <div class="light">
                                            <p>{{$donation->patient_age}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>عدد الأكياس المطلوبة</p>
                                        </div>
                                        <div class="light">
                                            <p>{{$donation->bags_num}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>المشفى</p>
                                        </div>
                                        <div class="light">
                                            <p>{{$donation->hospital_name}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>رقم الجوال</p>
                                        </div>
                                        <div class="light">
                                            <p>{{$donation->patient_phone}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="inside">
                                    <div class="info">
                                        <div class="special-dark dark">
                                            <p>عنوان المشفى</p>
                                        </div>
                                        <div class="special-light light">
                                            <p>{{$donation->hospital_address}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="details-button">
                            <a href="#">التفاصيل</a>
                        </div>
                    </div>
                    <div class="text">
                        <p>
                            {{$donation->details}}
                        </p>
                    </div>
                    <input type="hidden" id="lat" value="{{$donation->latitude}}" name="">
                    <input type="hidden" id="long" name="" value="{{$donation->longitude}}">

                    <div id="map" style="width:100%;height:500px;"></div>
                    </div>
                </div>
            </div>
        </div>
        
        
@endsection

@push('scripts')
<script type="text/javascript">
let map;
     function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 10,
      center: new google.maps.LatLng($('#lat').val(),$('#long').val()),

    //   center: uluru,
    });
    // The marker, positioned at Uluru
    const marker = new google.maps.Marker({
    //   position: uluru,
       position: new google.maps.LatLng($('#lat').val(),$('#long').val()),
      map: map,
    });
  }

</script>

<script type="text/javascript"
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2m3PiWIAguADvzvo5WMp4H51cABXgSpg&callback=initMap&language=ar&region=EG"
async
></script> 

@endpush