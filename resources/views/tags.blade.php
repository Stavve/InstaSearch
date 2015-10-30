@extends('app')
@section('content')


    <div class="container">

        <h1 align="center">Tags on <img src="../public/img/instagram-logo.png" height="150" alt=""/></h1>


        {!!Form::open(['route'=>'tags', 'method' => 'post', 'id' => "theForm"])!!}

        @if($errors)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">{{$error}}</div>
                @endforeach
        @endif

        

        <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">#</span>
          {!!Form::text('tag',null,['class'=>'form-control', 'placeholder'=>'example: iLoveFood'])!!}
        </div>
        
        <br>

        <div class="form-group">
        {!!Form::submit('Get media',['class' => 'btn btn-primary', 'id' => 'JRequest'])!!}
        </div>

        {!!Form::close()!!}

       <br/>

        @if(isset($dbPhotos))

        <h2>You search for: #{{str_replace(' ','',Input::get('tag'))}} </h2>
       
        @endif
       <hr/>

      
       @if(isset($dbPhotos))
           @foreach($dbPhotos as $photo)
               <div class="col-xs-6 col-md-3">
                   <div class="thumbnail">
                       <a href="{{$photo->photoId}}" target="_blank">
                       <img src="{{$photo->photoId}}"  alt="">
                       </a>
                       <hr>
                       <p class="fa fa-user"> {{$photo->username}}</p>
                       <br>
                       <p class="fa fa-thumbs-o-up"> {{$photo->likes}}</p>
                   </div>
               </div>
           @endforeach

       @endif
    </div>
@endsection
