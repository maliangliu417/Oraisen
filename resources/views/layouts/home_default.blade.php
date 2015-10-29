<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <title>{!! $title !!}</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    {!! Html::style( 'css/bootstrap.min.css') !!}
    {!! Html::style( 'css/font-awesome.css' ) !!}
    {!! Html::style( 'css/style.css' ) !!}
    {!! Html::style( 'fonts/font.css' ) !!}

    @yield('customStyles')
    @yield('styles')

    {!! Html::script( 'js/jquery-1.11.1.min.js' ) !!}  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    @yield('customHeaderScript')
    @yield('headerJavascript')
</head>

<body>
	@if ( $title != 'Oraisen')
		@section('nav')
	        @include('home.admin_nav')
	    @show
	@endif

	@yield('pageContainer')

	@section('footer')
        @include('home.footer')
    @show

    <!--bootstrap-->
    {!! Html::script( 'js/bootstrap.min.js' ) !!}

	@yield('customFooterScript')
	@yield('footerJavascript')
</body>

</html>