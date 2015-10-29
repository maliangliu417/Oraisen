<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{!! csrf_token() !!}">
<title>Admin-user</title>
	<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
	{!! Html::style( 'css/bootstrap.min.css') !!}
    {!! Html::style( 'css/font-awesome.css' ) !!}
    {!! Html::style( 'css/style_admin.css' ) !!}
    {!! Html::style( 'fonts/font.css' ) !!}
    {!! Html::style( 'css/keen-dashboards.css' ) !!}
    @yield('headerStyles')
    @yield('headerJavascript')
</head>
<body>
 <section class="market-top">
    <div class="container1">
	 <div class="row pro-descp">
	 <div class="col-sm-12 top">
	   <ol class="breadcrumb breadcrumb-admin">
        <li><a href="#">Admin</a></li>
        <li class="market">Dashboard</li>        
        </ol>
         <div class="logout">
		    <p><a href="{!! url('admin/logout') !!}"><i class="fa fa-power-off"></i> Logout</a></p>
		 </div>		
	 </div>	
	 <div class="clearfix"></div>
	 </div>
	</div>
	<div class="blue-line"></div>
 </section>
<section class="content2">
   <div class="container1">

      <div class="row">
	  
	    <div class="col-sm-3 market-left">
		
			<div class="admin-profile">
				{!! Html::image("images/admin-profile-img.png", 'picture') !!}
				<h2>Devin Stephens</h2>
				<p><span><a href="#"><img src="images/admin-country-logo1.png" alt=""/></a></span>UK,Londan</p>
			</div>
			
			<div class="market-left1">
			<h3>OPTION</h3>
				<div class="option-type">
				  <a href="{!! url('admin') !!}">{!! Html::image("images/admin-home-logo.png", 'picture') !!}Home</a>
				  <a href="{!! url('manage/product') !!}">{!! Html::image("images/admin-config.-logo.png", 'picture') !!}Manage Product</a>
				</div>
			
			</div>		
		</div>
		@yield('pageContainer')
		<div class="clearfix"></div>
	  </div>
   </div>

</section>
<footer>
	<div class="footer-text">
		&copy; 2015 Oraisen. All rights reseved.
	</div>
</footer>
  {!! Html::script( 'js/jquery.js' ) !!} 
  {!! Html::script( 'js/bootstrap.min.js' ) !!} 
  {!! Html::script( 'js/keen.min.js' ) !!} 
  {!! Html::script( 'js/keen.dashboard.js' ) !!} 

  @yield('footerJavascript')

  </body>
</html>