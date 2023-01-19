@extends('front.master',['class'=>'create','home'=>'','about'=>'','aboutus'=>'','contactus'=>'','donations'=>'','posts'=>''])
@section('content')        
     <!--form-->
        <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front-home')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">معلوماتي</li>
                        </ol>
                    </nav>
                </div>
                <div class="account-form">
                    <form action="{{route('updateprofile')}}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="text" name="name" class="form-control" value="{{$client->name}}" id="name" aria-describedby="emailHelp" placeholder="الإسم">
                        @error('name')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror                    
                        <input type="email" name="email" class="form-control" value="{{$client->email}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="البريد الإلكترونى">
                        @error('email')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror
                    
                        <input placeholder="تاريخ الميلاد" name="d_o_b" class="form-control" value="{{$client->d_o_b}}" type="text" onfocus="(this.type='date')" id="date">
                        @error('d_o_b')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror
                    
                        <select class="form-control" id="bloodtypes" name="blood_type_id">
                            @foreach ($blood_types as $blood_type)
                            <option value="{{$blood_type->id}}" @if($blood_type->id==$client->blood_type_id) selected @endif>{{$blood_type->name}}</option>
                            @endforeach
                        </select>
                        @error('blood_type_id')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror
                    
                        <select class="form-control" id="governorates" name="governorate_id">
                            {{-- <option selected disabled  value="">المحافظة</option> --}}
                            @foreach ($governorates as $governorate)
                            <option value="{{$governorate->id}}" @if($governorate->id==$client->city->governorate_id) selected @endif>{{$governorate->name}}</option>
                            @endforeach
                          </select>
                          @error('governorate_id')
                          <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                          @enderror
                      
                        <select class="form-control" id="cities" name="city_id">
                            @foreach ($cities as $city )
                            <option  value="{{$city->id}}" @if($client->city_id==$city->id) selected @endif>{{$city->name}}</option>
                            @endforeach
                            {{-- @foreach ($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach --}}

                        </select>
                        @error('city_id')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror
                    
                        <input type="text" value="{{$client->phone}}" class="form-control" name="phone" id="phonenumber" aria-describedby="emailHelp" placeholder="رقم الهاتف">
                        @error('')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror
                    
                        <input placeholder="آخر تاريخ تبرع" value="{{$client->last_donation_date}}" name="last_donation_date" class="form-control" type="text" onfocus="(this.type='date')" id="donation_date">
                        @error('last_donation_date')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror
                    
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور">
                        @error('password')
                        <small id="emailHelp" class="form-text font-weight-bold text-danger">{{$message}}</small>
                        @enderror
                    
                        <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2" placeholder="تأكيد كلمة المرور">
                        @error('password_confirmation')
                        <small id="emailHelp" class="form-text font-weight-bold  text-danger">{{$message}}</small>
                        @enderror
                    
                        <div class="create-btn">
                            <input type="submit" value="تعديل">
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
</script>

@endpush