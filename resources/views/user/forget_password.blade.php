<!DOCTYPE html>
<html>
<head>
    <title>{!! $title !!}</title>
    <style type="text/css">
       *{  
          margin:0;
          padding:0;
        }

        body{
          
          background-color:#f0f0f0;
          font-family:helvetica;
        }

        a{
          display:block;
          color:#ad5482;  
          text-decoration:none;
          font-weight:bold;
          margin-top:40px;
          text-align:center;
        }

        #bg{
          position:relative;
          top:20px;
          height:600px;
          width:800px;
          background:url('http://i.imgur.com/3eP9Z4O.png') center no-repeat;
          background-size:cover;
          margin-left:auto;
          margin-right:auto; 
          border:#fff 15px solid;
        }

        .module{
          position:relative;
          top:15%;    
          height:70%;
          width:450px;
          margin-left:auto;
          margin-right:auto;
          border-radius:5px;
          background:RGBA(255,255,255,1);
            
          -webkit-box-shadow:  0px 0px 15px 0px rgba(0, 0, 0, .45);        
          box-shadow:  0px 0px 15px 0px rgba(0, 0, 0, .45);
          
        }

        .module ul{
          list-style-type:none;
          margin:0;
        }

        .tab{
          float:left;
          height:60px;
          width:25%;
          padding-top:20px;
          box-sizing:border-box;
          background:#eeeeee;  
          text-align:center;
          cursor:pointer;
          transition:background .4s;
        }

        .tab:first-child{  
          -webkit-border-radius: 5px 0px 0px 0px;
          border-radius: 5px 0px 0px 0px;
        }

        .tab:last-child{  
          -webkit-border-radius: 0px 5px 0px 0px;
          border-radius: 0px 5px 0px 0px;
        }

        .tab:hover{  
          background-color:rgba(0,0,0,.1);
        }

        .activeTab{
          background:#fff;
        }

        .activeTab .icon{
          opacity:1;
        }

        .icon{
          height:24px;
          width:24px;
          opacity:.2;
        }

        .form{
          float:left;
          height:86%;
          width:100%;
          box-sizing:border-box;
          padding:40px;
        }

        .textbox{
          height:50px;
          width:100%;
          border-radius:3px;
          border:rgba(0,0,0,.3) 2px solid;
          box-sizing:border-box;
          padding:10px;
          margin-bottom:30px;
        }

        .textbox:focus{
          outline:none;
           border:rgba(24,149,215,1) 2px solid;
           color:rgba(24,149,215,1);
        }

        .button{
          height:50px;
          width:100%;
          border-radius:3px;
          border:rgba(0,0,0,.3) 0px solid;
          box-sizing:border-box;
          padding:10px;
          margin-bottom:30px;
          background:#90c843;
          color:#FFF;
          font-weight:bold;
          font-size: 12pt;
          transition:background .4s;
          cursor:pointer;
        }

        .button:hover{
          background:#80b438;
          
        }
        select{
            margin-top: 70px;
        }
        .error{
            color: rebeccapurple;
        }
        #login-submit{
            margin-top: 30px;
        }
        .container .label{
            display: block;
            margin-top: 45px;
        }
    </style>
</head>
<body>
    <div class="container">
        {!! Form::open(array('url' => 'request/password', 'method' => 'post', 'class' =>'button', 'id' => 'signupForm')) !!}
            @include('flash::message')
            <label class="label">Email : </label>
            <input type="text" placeholer="email" name="email" class="textbox" required>
            <input type="submit" id="login-submit" class="button" value="Submit"/>
        {!! Form::close() !!}
    </div>
</body>
    {!! Html::script( 'js/jquery.js' ) !!}

    {!! Html::script( 'js/jquery.validate.js' ) !!}
    <script type="text/javascript">
        $.validator.setDefaults({
                submitHandler: function(form) {
                    form.submit();
                }
        });
         $("#signupForm").validate({
                rules: {
                    email: {
                            required: true,
                            email: true
                    }
                },
                    messages: {
                            email: "Please enter a valid email address"
                    }
                });
    </script>
</html>

