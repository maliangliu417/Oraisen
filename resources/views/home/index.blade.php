@extends('layouts.home_default')

@section('customStyles')
	<!-- Particle effect style -->
    {!! Html::style( 'css/particles.css' ) !!}
    <!-- Particle effect style end -->
    <!--form validation-->
    {!! Html::style( 'css/screen.css' ) !!}
    {!! Html::style( 'css/cmxform.css' ) !!}
@stop

@section('styles')
	<style>
        #signupForm label.error {
            margin-left: 10px;
            width: auto;
            display: inline;
        }
        #newsletter_topics label.error {

            margin-left: 103px;
        }

        form.cmxform label.error {
            display: none;
        }
        .social-button span{
            font-size: 20px;
        }
        .container .close{
            position: relative;
            font-size: 35px;
        }
    </style>
@stop

@section('customHeaderScript')
	<!--smooth-scroll-->
    {!! Html::script( 'js/jquery.js' ) !!}	 
@stop

@section('headerJavascript')

	<script>
                    $(function() {
                    $('a[href*=#]:not([href=#])').click(function() {
                    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {

                    var target = $(this.hash);
                            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                            if (target.length) {
                    $('html,body').animate({
                    scrollTop: target.offset().top
                    }, 1500);
                            return false;
                    }
                    }
                    });
                    });</script>

        {!! HTML::script( 'js/jquery-1.8.3.js' ) !!}
        <script>
                    $('.navbar-wrapper a').on('click', function() {

            var scrollAnchor = $(this).attr('data-scroll'),
                    scrollPoint = $('section[data-anchor="' + scrollAnchor + '"]').offset().top - 28;
                    $('body,html').animate({
            scrollTop: scrollPoint
            }, 100);
                    return false;
            })

                    $(window).scroll(function() {
            var windscroll = $(window).scrollTop();
                    if (windscroll >= 50) {
            $('.navbar-wrapper').addClass('fixedmenu');
                    $('body section').each(function(i) {
            if ($(this).position().top <= windscroll + 10) {
            $('.navbar-wrapper .navbar a.active').removeClass('active');
                    $('.navbar-wrapper .navbar a').eq(i).addClass('active');
            }
            });
            } else {

            $('.navbar-wrapper').removeClass('fixedmenu');
                    $('.navbar-wrapper .navbar a.active').removeClass('active');
                    $('.navbar-wrapper .navbar a:first').addClass('active');
            }

            }).scroll();</script>
        <!--country-->
        {!! HTML::script( 'js/countries.js' ) !!}
        <!--country-->
        <!--datelist--> 
        {!! HTML::script( 'js/jquery-2.1.1.min.js' ) !!}
        {!! HTML::script( 'js/jquery.dateLists.min.js' ) !!}
        <script type="text/javascript">
                    $().ready(function() {
            $('#fld_example1').dateDropDowns({ dateFormat: 'dd/mm/yy' });
                    $('#fld_example2').dateDropDowns({ dateFormat: 'dd/mm/yy' });
            });</script>  
        <!--datelist-->
        <script>
            $(document).ready(function(){
                $(".forget-rt").click(function(){
                    $(".password_bg").slideDown(200);
                });
                $(".closeforget").click(function(){
                    $(".password_bg").slideUp(200);
                });

            });
        </script>
@stop

@section('pageContainer')	
	<div class="navbar-wrapper ">
            <div class="container1">
                <!-- Button trigger modal -->
                <div class="register-btn">
                    <div class="register-box">
                        <button type="button" class="btn btn-primary btn-lg register" data-toggle="modal" data-target="#myModal">
                            <img src="images/login-arrow.png" alt=""/>register</button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <button id="btnclose" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div class="modal-dialog">     
                            <div class="modal-content">        
                                <div class="modal-body register-h">
                                    <h2>Register</h2>
                                    {!! Form::open(array('url' => 'user/signup', 'method' => 'post', 'class' => 'cmxform', 'id' => 'signupForm', 'name' => 'form')) !!}                                      
                                        
                                        <div class="row">
                                            <div class="loginnew loginnew1 col-sm-6">
                                                <input type="text" name="usrFrsName" id="firstname" placeholder="First Name"  />		                   
                                                <input type="text" name="usrName" id="username-2" placeholder="Username" />
                                                <input type="password" name="usrPwd" id="password-2" placeholder="Password" />
                                            </div>  
                                            <div class="loginnew loginnew1 col-sm-6">
                                                <input type="text"  name="usrLstName" id="lastname" placeholder="Last Name" />
                                                <input type="text" name="email" id="email" placeholder="Email"  >
                                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Verify Password" />						   
                                            </div>						
                                        </div>	


                                        <div class="row">
                                            <div class="loginnew loginnew1 signup col-sm-12">
                                                <label>Sign up as :</label>
                                            </div>
                                            <div class="loginnew loginnew1 col-sm-12">
                                                <select name="usrPermission" id="option" title="Please select one!" class="selective" required>
                                                    <option value="">Select one</option>
                                                    <option value="Marketer">Marketer</option>
                                                    <option value="Provider">Provider</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="size">Select the Country :</div>
                                                <select onchange="print_state('state', this.selectedIndex);" id="country" name="usrCountry" required="required" title="please select country!">
                                                    <option value="">-- Select --</option>
                                                </select>
                                                <div class="size">Select State : </div>
                                                <select name="usrState" id="state" required="required" title="please select state!">
                                                    <option value="">-- Select --</option>
                                                </select>
                                                <script>print_country("country");</script>  
                                            </div>
                                        </div>
                                        <div class="loginnew loginnew1">
                                            <input type="text" name="usrZipcode" id="txtzip" placeholder="Zipcode">
                                        </div>
    
                                        <div class="loginnew loginnew1">
                                            <div class="gender">
                                             <div class="row">
                                               <div class="col-sm-6 col-xs-3">
                                                 <div class="gender-h"><label>Gender</label></div> 
                                               </div>
                                               <div class="col-sm-6 col-xs-9  gender-opt">
                                                <!--<div class="row gender-opt">
                                                  <div class="col-sm-6 col-xs-5">
                                                    <label class="remember"><input type="radio" name="gender" value="male" id="gender" required/><span class="check"></span>Male</label>
                                                  </div>
                                                  <div class="col-sm-6 col-xs-7">
                                                    <label class="remember"><input type="radio" name="gender" value="female" id="female"/><span class="check"></span>Female</label>
                                                  </div>
                                                </div>-->
                                                <label>Male</label>                          
                                                <input type="radio" name="usrGender" value="male" id="gender" required>
                                                <label>Female</label>
                                                <input type="radio" name="usrGender" value="female" id="female">
                                                <label for="gender" class="error"></label>
                                               </div>
                                             </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12"><div class="drop">  
                                                    <label>Date of Birth</label>							   
                                                    <div class="example"> 
                                                        <div class="input">        
                                                            <input type="text" id="fld_example1" name="fld_example1" value="Day/Month/Year" readonly="readonly" disabled="disabled"/>
                                                            <div class="clearfix"></div>
                                                        </div> </div>
                                                </div>
                                            </div></div>

                                        <div class="loginnew">

                                            <input type="submit" value="Submit"/>
                                        </div>  	
                                    {!! Form::close() !!}
                                </div>    
                            </div>
                        </div>
                    </div>
                </div><!--register-btn-->
                <div class="container1">
                    <div class="navbar navbar-inverse navbar-static-top" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse" id="top">
                            <ul class="nav navbar-nav menu">
                                <!--<li><a href="#home" data-scroll="home">Home</a></li>-->
                                <li><a href="#about" data-scroll="about">How it Works</a></li>
                                <li><a href="#marketer" data-scroll="marketer">Marketers</a></li>
                                <li><a href="#provider" data-scroll="provider">Businesses</a></li>

                            </ul>
                        </div>
                    </div>
                </div><!--container-->
                <div class="login-btn">
                    <div class="login-box">
                        <button type="button" class="btn btn-primary btn-lg login" data-toggle="modal" data-target="#myModal1">
                            login<img src="images/register-arrow.png" alt=""/></button></div>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-hidden="true">
                        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                        <div class="modal-dialog">    
                            <div class="modal-content">        
                                <div class="modal-body">
                                    {!! Html::image("images/logo.png", 'picture') !!}
                                    <h2>Login</h2> 	
                                    {!! Form::open(array('url' => 'user/login', 'method' => 'post', 'class' => '', 'id' => 'formlogin', 'name' => 'formlogin')) !!}				  
                                        <div class="loginnew">
                                            <div class="input">
                                                <i class="icon-prepend fa fa-envelope-o"></i> 
                                                <input type="text" name="email" id="username-1" placeholder="E-mail" />
                                            </div>

                                            <div class="input">
                                                <i class="icon-prepend fa fa-lock"></i>
                                                <input type="password" id="password-1" name="usrPwd" placeholder="Password" />
                                            </div>                              
                                    
                                            <div class="row forgetpass">
                                                <div class="col-sm-6"><a href="{!!url('forget/username')!!}" class="forget-rt">Forgot Password?</a></div>
                                                <div class="col-sm-6"><label class="remember"><input type="checkbox"/><span class="check"></span>Remember me</label></div>                                    
                                            </div>
                                            <!--<div class="row">
                                                <div class="col-sm-6">
                                                    <a href="{!!url('forget/username')!!}" class="username">Forgot my username</a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a href="{!!url('forget/password')!!}" class="password">Forgot my password</a>
                                                </div>
                                            </div>	-->
                                            <input type="submit" id="login-submit" value="Login"/>
                                            <div class="sighup">
                                                <h5>Not a Member? <a href="#">Sign up</a></h5>
                                                <a href="{!!url('facebook')!!}">{!! Html::image("images/login-fb.png", 'picture') !!}</a>
                                                <a href="{!!url('twitter')!!}">{!! Html::image("images/login-twitter.png", 'picture') !!}</a>
                                            </div>
                                            <p>© Oraisen 2015  Privacy Terms</p>
                                        </div>
                                    {!! Form::close() !!}						  
                                </div>     
                            </div>
                        </div>
                    </div>
                </div><!--login-btn-->
            </div><!--container1-->
        </div><!--navbar-wrapper-->
        <!-- banner    ================================================== -->
        <section id="home" data-0="background-position:center 0px;" data-100000="background-position:center 50000px;">
            <div class="home bg bg1" >
                <!-- Particles -->
                <div class="overlay">
                    <div style="display:none;" class="dots">
                        <div class="dot1" style="display: none; height: 0px; width: 0px;"></div>
                        <div class="dot2" style="display: none; height: 0px; width: 0px;"></div>
                        <div class="dot3" style="display: none; height: 0px; width: 0px;"></div>
                        <div class="dot4" style="display: none; height: 0px; width: 0px;"></div>
                        <div class="dot5" style="display: none; height: 0px; width: 0px;"></div>
                        <div class="dot6" style="display: none; height: 0px; width: 0px;"></div>
                        <div class="dot7" style="display: none; height: 0px; width: 0px;"></div>
                        <div class="dot8" style="display: none; height: 0px; width: 0px;"></div>
                        <div class="dot9" style="display: none; height: 0px; width: 0px;"></div>
                        <div class="dot10" style="display: none; height: 0px; width: 0px;"></div>
                    </div>
                    <!-- End Particles -->

                    <div class="container">

                    @if ( !is_null(Session::get('confirm_alert')) )
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">
                               ×
                            </button>
                            <i class="fa fa-check-circle"></i><strong> Success!</strong>
                            @if (is_array(Session::get('confirm_alert')))
                            <ul>
                                @foreach (Session::get('confirm_alert') as $success)
                                <li>
                                    {{ $success }}
                                </li>
                                @endforeach
                            </ul>
                            @else
                            {{ Session::get('confirm_alert') }}
                            @endif
                        </div>
                    @endif
                    
                    @include('flash::message')
                        <div class="carousel-caption">
                            <a class="logo" href="#">{!! Html::image("images/logo.png", 'picture') !!}</a>
                            <div class="banner-text">
                                <h2><span>Inspire.</span> Sell. Earn.</h2>
                                <p>The global platform for marketing goods and services.</p>
                                <p><a class="learn" href="{!!url('marketer')!!}" role="button">LEARN MORE</a></p>
                            </div>
                        </div>
                        <div class="top-arrow">
                          <p>Scroll Down</p>
                          <a href="#about">{!! Html::image("images/top-arrow.png", 'picture') !!}</a>
                        </div>
                    </div>
                    <!-- particle overlay --></div><!-- particle overlay end-->
            </div>
        </section>
        <section id="about">
               <div class="parallax-window1 about mainhead" data-0="background-position:center -500px;" data-100000="background-position:center 60000px;">
                <h2>How it Works</h2>
                <img src="images/line.png" alt=""/>
                <p>Customers can't buy from you<span>if they don't know you exist. </span>Oraisen establishes that vital connection.</p>
                <div class="container">
                  <div class="row">
                    <div class="col-sm-4">
                        <div class="about-left">
                            <h2>Marketers</h2>
                            <p>Will be able to get leads,<br/>
                                generate sales for products and <br/>services and get paid a commission</p>
                        </div>     
                    </div>
                     <div class="col-sm-4 about-center">
                          <img src="images/circle.png" alt=""/>
                    </div>
                    <div class="col-sm-4">
                        <div class="about-left about-right">
                            <h2>Providers</h2>
                            <p>Will be able to expand the reach<br/>
                                of their products/services, by<br/>allowing the world to do the work.</p>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="howworks">
                <div class="container">
                  <h2>It’s incredibly simple</h2>
                 <div class="row">
                    <div class="col-sm-4">
                        <div class="about-mid about-mid1">
                            <img src="images/about1.png" alt=""/>
                            <h4>Post</h4>
                            <p>Providers places product in <br/>the market place.</p>          
                        </div>
                    </div>
                    <div class="col-sm-4 marketer-new">
                        <div class="about-mid about-mid2">
                            <img src="images/about2.png" alt=""/>
                            <h4>Find</h4>
                            <p>Marketers find product,<br/> sends traffic, and gets<br/> provider a sale.</p>          
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="about-mid about-mid1">
                            <img src="images/about3.png" alt=""/>
                            <h4>Earn</h4>
                            <p>Provider pays marketer a<br/> commission.</p>           
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </section>
        
        <div class="parallax-window2" data-0="background-position:center -1500px;" data-100000="background-position:center 82000px;">
            <section id="marketer" class="marketer">
                <div class="container mainhead">
                    <h2>Marketing Experts</h2>
                    <img src="images/line1.png" alt=""/>
                    <h3>Are you a highly-skilled designer or a killer content writer?</h3>
                    <p>Need marketing wizards like you to help sell their products and services.<span>Take advantage of this fantastic global marketplace,</span> help businesses to generate sales and earn money in the process!</p>
                </div><!--container-->

                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="marketer-left">
                                <img src="images/icon02.png" alt=""/>
                            </div>     
                        </div>
                      
                    </div>                   
                    <div class="register-btn">
                        <div class="marketer-left">
                            <button id="btnmarketer" type="button" class="btn btn-primary btn-lg button1" data-toggle="modal" data-target="#myModal">
                                SIGN UP AS MARKETER</button>
                        </div>                                            
                    </div><!--register-btn-->

                </div>  
            </section>
        </div>
    <section id="provider">
              <div class="parallax-window3 provider">
                <div class="container mainhead">
                    <h2>Businesses</h2>
                    <img src="images/line1.png" alt=""/>
                    <h3>Within minutes, Oraisen puts you in direct contact with thousandsof talented experts</h3>
                    <p>Experts ready to professionally market the productsand services that your business has to offer. Just provide the basic details of your business and what it offers,and our network of professionals will promote it quicker and better thanyou can imagine!You determine your own milestones and have complete controlover commission levels for successful sales.</p>
                    <div class="row">
                      <div class="col-sm-12">
                            <div class="marketer-left">
                                <img alt="" src="images/icon01.png">
                            </div>     
                        </div>
                    </div>
                      <div class="register-btn">
                        <div class="marketer-left marketer-left1">
                            <button id="btnprovider" type="button" class="btn btn-primary btn-lg button1 button2" data-toggle="modal" data-target="#myModal">
                                SIGN UP AS PROVIDER</button>
                        </div>
                        
                    </div><!--register-btn-->
                    
                     </div><!--container--> 
                     </div>
            <div class="business-type">
              <h2>Types of Businesses</h2>
               <div class="container">
                    <div class="service">
                        <div class="provider-box">
                            <img src="images/pro1.png" alt=""/>
                            <h2>Virtual goods</h2>
                        </div>
                        <div class="provider-box">
                            <img src="images/pro2.png" alt=""/>
                            <h2>Physical goods</h2>
                        </div>
                        <div class="provider-box">
                            <img src="images/pro3.png" alt=""/>
                            <h2>Real Estate</h2>
                        </div>
                        <div class="provider-box">
                            <img src="images/pro4.png" alt=""/>
                            <h2>Automotive</h2>
                        </div>
                        <div class="provider-box">
                            <img src="images/pro5.png" alt=""/>
                            <h2>Service providers</h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                   
                    </div>
               </div>
            </section>
        </div>
@stop

@section('customFooterScript')
   
    {!! Html::script( 'js/countries.js' ) !!}
    <!--bootstrap-->
    <!--Parallax effect
    <script type="text/javascript" src="js/skrollr.min.js"></script>

    <script type="text/javascript">
                                                        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) === false) {
                                                skrollr.init({
                                                forceHeight: false
                                                });
                                                }
    </script>

	-->

    {!! Html::script( 'js/jquery.js' ) !!}

    {!! Html::script( 'js/jquery.validate.js' ) !!}
@stop

@section('footerJavascript')
	<script>
                                                        $.validator.setDefaults({
                                                        submitHandler: function(form) {
                                                            
                                                            var url = $(form).attr('action') ;
                                                            var data = $(form).serialize();
                                                            $.ajaxSetup(
                                                            {
                                                                headers:
                                                                {
                                                                    'X-CSRF-Token': $('input[name="_token"]').val()
                                                                }
                                                            });

                                                            $.ajax({
                                                                url: url,
                                                                data: data,
                                                                type: 'POST',
                                                                success: function(response) {
                                                                    if(response.message == 'login_success')
                                                                    {
                                                                        location.href = 'dashboard';
                                                                    }
                                                                    else if(response.message == 'signup_success')
                                                                    {console.log('ddsdssd');
                                                                        location.href = 'dashboard';
                                                                    }
                                                                    else
                                                                        alert(response.message);
                                                                },
                                                                error:function(error)
                                                                {console.log(error);}
                                                            }); 

                                                        }
                                                        });
                                                        $().ready(function() {
                                                // validate the comment form when it is submitted
                                                $("#commentForm").validate();
                                                        // validate signup form on keyup and submit
                                                        $("#signupForm").validate({
                                                rules: {
                                                usrFrsName: "required",
                                                        usrLstName: "required",
                                                        usrName: {
                                                        required: true,
                                                                minlength: 2
                                                        },
                                                        usrPwd: {
                                                        required: true,
                                                                minlength: 5
                                                        },
                                                        confirm_password: {
                                                        required: true,
                                                                minlength: 5,
                                                                equalTo: "#password-2"
                                                        },
                                                        email: {
                                                        required: true,
                                                                email: true
                                                        },
                                                        topic: {
                                                        required: "#newsletter:checked",
                                                                minlength: 2
                                                        },
                                                        agree: "required",
                                                        usrZipcode: {
                                                        required: true,
                                                                zipcode: true,
                                                        }
                                                },
                                                        messages: {
                                                        usrFrsName: "Please enter your firstname",
                                                                usrLstName: "Please enter your lastname",
                                                                usrName: {
                                                                required: "Please enter a username",
                                                                        minlength: "Your username must consist of at least 2 characters"
                                                                },
                                                                usrPwd: {
                                                                required: "Please provide a password",
                                                                        minlength: "Your password must be at least 5 characters long"
                                                                },
                                                                confirm_password: {
                                                                required: "Please provide a password",
                                                                        minlength: "Your password must be at least 5 characters long",
                                                                        equalTo: "Please enter the same password as above"
                                                                },
                                                                email: "Please enter a valid email address",
                                                                agree: "Please accept our policy",
                                                                usrZipcode : "Please zipcode",
                                                        },
                                                });
                                                        // validate login form on keyup and submit
                                                        $("#formlogin").validate({
                                                rules: {
                                                Uname: "required",
                                                        Upwd: "required"

                                                },
                                                        messages: {
                                                        Uname: "Please enter your username",
                                                                Upwd: "Please enter your password"
                                                        },
                                                });
                                                        // propose username by combining first- and lastname
                                                        $("#username").focus(function() {
                                                var firstname = $("#firstname").val();
                                                        var lastname = $("#lastname").val();
                                                        if (firstname && lastname && !this.value) {
                                                this.value = firstname + "." + lastname;
                                                }
                                                });
                                                        //code to hide topic selection, disable for demo
                                                        var newsletter = $("#newsletter");
                                                        // newsletter topics are optional, hide at first
                                                        var inital = newsletter.is(":checked");
                                                        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
                                                        var topicInputs = topics.find("input").attr("disabled", !inital);
                                                        // show when newsletter is checked
                                                        newsletter.click(function() {
                                                        topics[this.checked ? "removeClass" : "addClass"]("gray");
                                                                topicInputs.attr("disabled", !this.checked);
                                                        });
                                                });
                                                jQuery.validator.addMethod("zipcode", function(value, element) {
                                                  return this.optional(element) || /^\d{5}(?:-\d{4})?$/.test(value);
                                                }, "Please provide a valid zipcode.");</script>
    <script>
                $(document).ready(function(e) {
        $('#btnmarketer').click(function(){
        $('#option').val('Marketer') = "selected";
        });
                $('#btnprovider').click(function(){
        $('#option').val('Provider') = "selected";
        });
                $('#btnclose').click(function(){
        $('#option').val('') = "selected";
        });
        });
    </script>
    <!--form validation-->
@stop