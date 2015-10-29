<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta name="csrf-token" content="{!! csrf_token() !!}">
<title>Admin-user</title>
<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    {!! Html::style( 'css/bootstrap.min.css') !!}
    {!! Html::style( 'css/font-awesome.css' ) !!}
    {!! Html::style( 'css/style_admin.css' ) !!}
    {!! Html::style( 'fonts/font.css' ) !!}
</head>
<body>
<div class="admin-login">
  <div class="login">
     {!! Html::image(url("images/logo.png"), 'picture') !!}
	 <h2>Welcome, <span>please login</span></h2>
   {!! Form::open(array('url' => 'pass/login', 'method' => 'post', 'class' =>'button', 'id' => 'loginForm')) !!}
  	  <label class="input">
  		<i class="icon-prepend fa fa-user"></i> 
          <input type="text" name="email" placeholder="Login" id="name" required>
        </label>
  	  <label class="input">
  		<i class="icon-prepend fa fa-lock"></i> 
          <input type="password" name="password" placeholder="Password" id="name" required>
        </label>
  	  <input type="submit" value="login"/>
	  {!! Form::close() !!}
	  <p>&copy; 2015 Oraisen. All rights reserved.</p>
  </div>
</div>
 <!--bootstrap-->   
  {!! Html::script( 'js/jquery.js' ) !!}
  {!! Html::script( 'js/bootstrap.min.js' ) !!} 
  {!! Html::script( 'js/jquery.validate.js' ) !!}

   <script type="text/javascript">
      $("#loginForm").validate({
          rules: {
              email: {
                  required:true,
                  email:true
              },
              password: {
                  required: true,
              }
          },
          messages: {
                  email: {required: "Please input the email.",
                          email: "please enter invalid email."},
                  password: {required: "Please input the password."}
          },
          submitHandler: function(form) {
               form.submit();
          }

      });
   </script>
  </body>
</html>