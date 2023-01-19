@extends('front.master',['class'=>'create','home'=>'','about'=>'','aboutus'=>'','contactus'=>'','donations'=>'','posts'=>''])
@section('content')        
     <!--form-->
        <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front-home')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">طلب تبرع</li>
                        </ol>
                    </nav>
                </div>
                <div class="account-form">
                    <form action="{{route('send-request')}}" method="post">            
                        @csrf
                        <input type="text"  class="form-control" name="patient_name" aria-describedby="emailHelp" placeholder="الإسم">
                        @error('patient_name')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror                    
                        <input type="text" name="patient_phone" class="form-control" id="exampleInput2" aria-describedby="emailHelp" placeholder="رقم التليفون">
                        @error('patient_phone')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror
                        
                        <input type="text" name="patient_age" class="form-control"  aria-describedby="emailHelp" placeholder="السن">
                        @error('patient_phone')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror

                        <input type="text" name="hospital_name" class="form-control"  aria-describedby="emailHelp" placeholder="اسم المستشفي">
                        @error('hospital_name')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror 
                        
                        <input type="text" name="hospital_address" class="form-control"  aria-describedby="emailHelp" placeholder="عنوان المستشفي">
                        @error('hospital_address')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror                    


                        <select class="form-control" id="bloodtypes" name="blood_type_id">
                            <option selected disabled  value="">فصيلة الدم</option>
                            @foreach ($blood_types as $blood_type)
                            <option value="{{$blood_type->id}}">{{$blood_type->name}}</option>
                            @endforeach
                        </select>
                        @error('blood_type_id')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror
                    
                        <select class="form-control" id="governorates" name="governorate_id">
                            <option selected disabled  value="">المحافظة</option>
                            @foreach ($governorates as $governorate)
                            <option value="{{$governorate->id}}">{{$governorate->name}}</option>
                            @endforeach
                          </select>
                          @error('governorate_id')
                          <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                          @enderror
                      
                        <select class="form-control" id="cities" name="city_id">
                            <option  selected disabled  value="">المدينة</option>
                        </select>
                        @error('city_id')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror
                    
                        <input type="number" class="form-control" name="bags_num"  aria-describedby="emailHelp" placeholder="عدد الاكياس">
                        @error('bags_num')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror
                        
                        <textarea class="form-control" name="details" id="exampleFormControlTextarea1" rows="3" placeholder="التفاصيل"></textarea>
                        @error('details')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror

                        <input type="text" class="form-control" name="latitude" id="lat"  aria-describedby="emailHelp" placeholder="latitude">
                        @error('latitude')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror

                        <input type="text" class="form-control" name="longitude" id="long"  aria-describedby="emailHelp" placeholder="longitude">
                        @error('longitude')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror

                        <!--The div element for the map -->                  
                          <div id="map" style="width:100%;height:500px;"></div>
                        <div class="create-btn">
                            <input type="submit" value="إنشاء">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
@endsection       
@push('scripts')
<script type="text/javascript">
  $(function() {
    $('#governorates').change(function() {
        var governorate_id = $(this).find(":selected").val();
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/api/v1/cities',
            data: {'governorate_id': governorate_id},
            success: function(data){
                if(data.status==1){
                    $('#cities').empty()
                    $('#cities').append('<option selected disabled value="">المدينة</option>')
              let cities=data.data
              for(let city of cities){
                $('#cities').append('<option value="'+city.id+'">'+city.name+'</option>')
              }
            }
            },
            error:function(){
                console.log('error')
            }
        });
    })
  })


  navigator.geolocation.getCurrentPosition(function(pos){
    initMap(pos.coords.latitude,pos.coords.longitude);
    
})
let map;

 // Initialize and add the map
 function initMap(lat,lng) {
    // The location of Uluru
    const uluru = { lat:lat, lng:lng};
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 10,
      center: new google.maps.LatLng(lat,lng),

    //   center: uluru,
    });
    // The marker, positioned at Uluru
    const marker = new google.maps.Marker({
    //   position: uluru,
       position: new google.maps.LatLng(lat,lng),
      map: map,
    });

    google.maps.event.addListener(marker,'position_changed',
                            function (){
                                let lat = marker.position.lat()
                                let lng = marker.position.lng()
                                $('#lat').val(lat)
                                $('#long').val(lng)
                            })

                            google.maps.event.addListener(map,'click',
                        function (event){
                            pos = event.latLng
                            marker.setPosition(pos)
                        })

              


  }

</script>

 <script type="text/javascript"
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2m3PiWIAguADvzvo5WMp4H51cABXgSpg&callback=initMap&language=ar&region=EG"
defer
></script> 


@endpush