@extends('front.master',['class'=>'donation-requests','home'=>'','about'=>'','aboutus'=>'','contactus'=>'','donations'=>'active','posts'=>''])
@section('content')        
       
        <!--inside-article-->
        <div class="all-requests">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front-home')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
                        </ol>
                    </nav>
                </div>
            
                <!--requests-->
                <div class="requests">
                    <div class="head-text">
                        <h2>طلبات التبرع</h2>
                    </div>
                    <div class="content">
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
                               <a class="donation_link" href="{{route('donation-details',$donation_request->id)}}">التفاصيل</a>
                           </div>
                           @endforeach   
                        </div>
                        {{-- <div class="pages">
                            <nav aria-label="Page navigation example" dir="ltr">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div> --}}
                        {!!$donation_requests->render()!!}
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
             $('.patients').append('<div class="details"><div class="blood-type"><h2 dir="ltr">'+donation.blood_type.name+'</h2></div><ul><li><span>اسم الحالة:</span>'+donation.patient_name+'</li><li><span>مستشفى:</span>'+donation.hospital_name+'</li><li><span>المدينة:</span>'+donation.city.name+'</li></ul><a href="'+$('#donation_link').attr('href')+'">التفاصيل</a></div>')
              }
            }
            },
            error:function(){
                console.log('error')
            }
        });
    })
  })
</script>

@endpush        
