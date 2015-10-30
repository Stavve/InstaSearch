@extends('app')
@section('content')
<div class="container">

	<img src="../public/img/Google_Maps_logo.png" height="110" alt=""/>&<img src="../public/img/instagram-logo.png" height="150" alt=""/>

	<h1 align="center">Photo by location</h1>

	@if($errors)
		@foreach ($errors->all() as $error) 
			<div class="alert alert-danger" role="alert">{{$error}}</div>
		@endforeach
	@endif

	{!!Form::model(['route' =>'location', 'method'=>'post'])!!}
	
		 <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-map-marker"></span></span>
          {!!Form::text('search',null,['class'=>'form-control', 'placeholder'  =>'City..'])!!}
        </div>

		<br>
		<div id="form-group">
			{!!Form::submit('Search',['class'=>'btn btn-primary'])!!}
		</div>

	{!!Form::close()!!}
    <hr/>

    <div class="row">
        @if(isset($dbPhotos))
                @foreach($dbPhotos as $photo)
                    <div class="col-xs-6 col-md-3">
                        <div class="thumbnail">
                            <a href="{{$photo->photoId}}" target="_blank"><img src="{{$photo->photoId}}" alt="picture from Instagram"/></a>
                            <hr>
                            <p class="fa fa-user"> {{$photo->username}}</p>
                            <br>
                            <p class="fa fa-thumbs-o-up"> {{$photo->likes}}</p>
                        </div>
                    </div>

        @endforeach
    @endif
    </div>


</div>
@stop