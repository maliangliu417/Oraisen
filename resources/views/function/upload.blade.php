<!DOCTYPE html>
<html>
<head>
	<title>Upload</title>
	{!! Html::style( 'css/bootstrap.min.css') !!}
	<style type="text/css">
	.about-section{
		display: block;
		width: 100%;
	}
	.text-content{
		display: block;
		padding: 20px;
		width: 300px;
		margin: 100px auto;
		border: 3px solid #dddafa;
		border-radius: 5px;
		background-color: #dddafa;
	}
	.secure{
		display: block;
		color: #6e2cf5;
		font-size: 25px;
		text-align: center;
		padding-bottom: 20px;
	}
	.send-btn{
		display: block;
		background-color: #b783fd;
		font-size: 20px;
		padding: 5px;
		border-radius: 10px;
		color: white;
		margin: 20px auto;
	}
	.controls input{
		border: 3px solid #ff8400;
		border-radius: 5px;
	}
	.errors{
		color: red;
		padding: 10px;
	}
	h4{
		font-size: 20px;
		color: #54ff00;
		text-align: center;
	}
	.page-move{
		margin: 100px;
		font-size: 30px;
		font-style: italic;
	}
	.page-move a{
		color: #b958f0;
		text-decoration: none;
	}
	.page-move a:hover{
		color: #f655c3;
	}
	.send-btn:hover{
		background-color: #f655c3;
	}
	</style>
</head>
<body>
	<div class="page-move">
		<a href="{!! url('profile/'.$usrName) !!}"><span>Go to Oraisen</span></a>
	</div>
	<div class="about-section">
	   <div class="text-content">
	   	@if($type == 'photo')
	     <div class="span7 offset1">
	        @if(Session::has('success'))
	          <div class="alert-box success">
	          <h4>{!! Session::get('success') !!}!</h4>
	          </div>
	        @endif
	        <div class="secure">Upload  {!! $type !!}</div>
	        {!! Form::open(array('url'=>'apply_upload/photo/'.$usrName,'method'=>'POST', 'files'=>true)) !!}
		        <div class="control-group">
		         	<div class="controls">
		        {!! Form::file('image') !!}
					<p class="errors">{!!$errors->first('image')!!}</p>
					@if(Session::has('error'))
					<p class="errors">{!! Session::get('error') !!}</p>
					@endif
		        	</div>
		        </div>
	        	<div id="success"> </div>
	      		{!! Form::submit('Submit', array('class'=>'send-btn')) !!}
	      	{!! Form::close() !!}
	      </div>
	    @elseif($type == 'video')
	      <div class="span7 offset1">
	        @if(Session::has('success'))
	          <div class="alert-box success">
	          <h4>{!! Session::get('success') !!}!</h4>
	          </div>
	        @endif
	        <div class="secure">Upload {!! $type !!}</div>
	        {!! Form::open(array('url'=>'apply_upload/video/'.$usrName,'enctype' => 'multipart/form-data','method'=>'POST', 'files'=>true)) !!}
		        <div class="control-group">
		         	<div class="controls">
		        {!! Form::file('video') !!}
					<p class="errors">{!!$errors->first('video')!!}</p>
					@if(Session::has('error'))
					<p class="errors">{!! Session::get('error') !!}</p>
					@endif
		        	</div>
		        </div>
	        	<div id="success"> </div>
	      		{!! Form::submit('Submit', array('class'=>'send-btn')) !!}
	      	{!! Form::close() !!}
	      </div>
	    @endif
	   </div>
	</div>
</body>
</html>