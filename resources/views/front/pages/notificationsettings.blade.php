@extends('front.master',['class'=>'who-are-us','home'=>'','about'=>'','aboutus'=>'','contactus'=>'','donations'=>'','posts'=>''])
@section('content')
<div class="about-us">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front-home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">اعدادات الاشعارات</li>
                </ol>
            </nav>
        </div>
        <div class="details mb-5">
            <div class="logo text-center">
                {{$settings->notification_settings_text}}
            </div>
        </div>

            {{-- @foreach ($blood_types as $blood_type)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="blood_types[]"  @if($blood_type->id==$client->blood_type_id) checked @endif value="{{$blood_type->id}}" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    {{$blood_type->name}}
                </label>
              
            @endforeach --}}
            <form action="{{route('notification-settings')}}" method="post">
                @csrf
                @method('PATCH')
            <h3 class="form-label" for="">فصائل الدم</h3>
            <div class="details mb-5">
                <div class="co1-8">
                    <div class="d-flex justify-content-center w-75">
                                     @foreach ($blood_types as $blood_type)
            <div class="form-check w-50">
                <input class="form-check-input" type="checkbox" name="blood_types[]"  @if(in_array($blood_type->id,$client->bloodTypes()->pluck('blood_types.id')->toArray())) checked @endif value="{{$blood_type->id}}" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    {{$blood_type->name}}
                </label>
            </div>
            @endforeach 


        </div>
                </div>
            </div>

            <h3 class="form-label" for="">المحافظات</h3>
            <div class="details">
                <div class="co1-8">
                    <div class="d-flex justify-content-center w-100">
                                     @foreach ($governorates as $governorate)
            <div class="form-check w-50">
                <input class="form-check-input" type="checkbox" name="governorates[]"  @if(in_array($governorate->id,$client->governorates()->pluck('governorates.id')->toArray())) checked @endif value="{{$governorate->id}}" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    {{$governorate->name}}
                </label>
            </div>
            @endforeach 


        </div>
                </div>
            </div>

            <div class=" d-flex justify-content-center mt-5 w-100" >
                <input class=" btn btn-success w-25 h-25" type="submit" value="تعديل">
            </div>

        </form>




    </div>
</div>


@endsection
