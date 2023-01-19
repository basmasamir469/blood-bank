@extends('front.master',['class'=>'article-details','home'=>'','about'=>'','aboutus'=>'','contactus'=>'','donations'=>'','posts'=>'active'])
@section('content')               
        <!--inside-article-->
        <div class="inside-article">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front-home')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item" aria-current="page">المقالات</li>
                        </ol>
                    </nav>
                </div>
                
                <!--articles-->
                <div class="articles">
                    {{-- <div class="title">
                        <div class="head-text">
                            <h2>مقالات ذات صلة</h2>
                        </div>
                    </div> --}}
                    <div class="view">
                        <div class="row">
                            <!-- Set up your HTML -->
                            @foreach ($posts as $post)
                             <div class=" col-4">                                 
                                <div class="card mb-5">
                                    <div class="photo">
                                        <img src="{{url('images/posts/'.$post->image)}}" class="card-img-top" alt="...">
                                        <a href="{{route('post-details',$post->id)}}" class="click">المزيد</a>
                                    </div>
                                    <a href="" class="favourite">
                                        <i class="far fa-heart {{auth('front')->user()->favPosts->contains($post->id)? 'fav':'' }}" onclick="toggle(this,event)" data-id="{{$post->id}}"></i>
                                    </a>
    
                                    <div class="card-body">
                                        <h5 class="card-title">{{$post->title}}</h5>
                                        <p class="card-text">
                                            {{$post->content}}
                                        </p>
                                    </div>
                                </div>    
                             </div> 
                             @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
@endsection

@push('scripts')
<script type="text/javascript">
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