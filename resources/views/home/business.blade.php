@extends('layouts.home_default')

@section('headerJavascript')
	<script type="text/javascript" >
	$(document).ready(function()
	{
	$(".menu-drop").click(function()
	{
	var X=$(this).attr('id');

	if(X==1)
	{
	$(".menu-dropdown").hide();
	$(this).attr('id', '0');	
	}
	else
	{
	$(".menu-dropdown").show();
	$(this).attr('id', '1');
	}
		
	});
	//Mouseup textarea false
	$(".menu-dropdown").mouseup(function()
	{
	return false
	});
	$(".menu-drop").mouseup(function()
	{
	return false
	});
	//Textarea without editing.
	$(document).mouseup(function()
	{
	$(".menu-dropdown").hide();
	$(".menu-drop").attr('id', '');
	});
	});
	</script>
	<script type="text/javascript" >
	$(document).ready(function()
	{
	$(".profile").click(function()
	{
	var X=$(this).attr('id');

	if(X==1)
	{
	$(".dropdown1").hide();
	$(this).attr('id', '0');	
	}
	else
	{
	$(".dropdown1").show();
	$(this).attr('id', '1');
	}
	});
	//Mouseup textarea false
	$(".dropdown1").mouseup(function()
	{
	return false
	});
	$(".profile").mouseup(function()
	{
	return false
	});
	//Textarea without editing.
	$(document).mouseup(function()
	{
	$(".dropdown1").hide();
	$(".profile").attr('id', '');
	});
		
	});
	</script>
	<!--toogle end-->
	<!--category-->
	 <script>
	$(document).ready(function(){
	  $(".categorymenu").click(function(){
	    $(".categorydrop").slideToggle('slow');
	  });
	});
	</script>
	<!--category end-->
	<!--tabs-->
	<script>
	$('#myTab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})
	</script>
	<!--tabs end-->
	<!--parallax-->
	  <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	 <script type="text/javascript">
				$(document).ready(function() {
					$(window).scroll(function(){
						$('*[class^="prlx"]').each(function(r){
							var pos = $(this).offset().top;
							var scrolled = $(window).scrollTop();
					    	$('*[class^="prlx"]').css('top', +(scrolled * 0.5) + 'px');			
					    });
					});
				});
			</script>
@stop

@section('pageContainer')
	<section class="parallax-main parallax-main1">
	<div class="prlx prlx-1"></div><!--parallax-->
	</section>
	 <section class="profile-top">
	    <div class="container1">
		 <div class="row pro-descp">
		 <div class="col-sm-6 profilelf">	  
			<div class="row">
			<div class="col-xs-4 prof-left">
			  <div class="profile-main"><img src="images/business-pro.png" alt=""/></div>
			</div>
			<div class="col-xs-8 profile-text">
			  <h2>Lowdi<img src="images/tick.png" alt=""/></h2>
			  <a href="#"><h4>www.lowdi.net</h4></a>
			 </div>
			<div class="clearfix"></div>
			</div><!--row-->
		 </div>
		 <div class="col-sm-6">
		    <div class="search-main">
			  <!--<input type="text" class="search1" placeholder="Search...">-->
			  <input class="search1" type="text" value="Search..." onblur="if(this.value=='')this.value='Search...';" 
	onfocus="if(this.value=='Search...')this.value='';" />
			</div>
		 </div>
		 <div class="clearfix"></div>
		 </div>
		</div>
	 </section>
	<section class="content1">
	   <div class="container1">
	      <div class="row">
		    <div class="col-sm-3 market-left">
			  <a class="button3" href="#"><img src="images/follow.png" alt=""/>FOLLOW</a>
			  <a class="button3 button4" href="#"><img src="images/mail.png" alt=""/>send message</a>
			   <div class="categorymenu">
	         <div class="categorynew"><span>category</span><img src="images/default.png" alt=""/></div>
				 <div class="clearfix"></div>
				<div class="categorydrop">
				   <ul>
				      <li class="virtual"><a href="virtual-goods.html">Virtual Goods</a></li>
					  <li class="psyhical"><a href="psyhical-goods.html">Psyhical Goods</a></li>
					  <li class="realestate"><a href="real-estate.html">Real Estate</a></li>
	                  <li class="automotive"><a href="automotive.html">Automotive</a></li>				  
					  <li class="services"><a href="service-provider.html">Service Providers</a></li>
				   </ul>			
				</div>
			 </div>
			  <div class="web">
			     <span>On the web</span>
				  <ul class="icons-new">
				    <li><a href="#"><img src="images/facebook.png" alt=""/></a></li>
					<li><a href="#"><img src="images/twit.png" alt=""/></a></li>
					<li><a href="#"><img src="images/g+.png" alt=""/></a></li>
				 </ul>
				 <div class="clearfix"></div>
				</div>
			  <div class="ranking">
			    <ul>			
				<li><span>Followers</span>97</li>
				<li><span>Comission</span>$16</li>
				</ul>      
	      <div class="clearfix"></div>
			  </div>
			   <div class="aboutme adres">
			    <h2>Address</h2>
				<p>745 Lyon Avenue Worcester, MA </p>
			  </div>
			   <div class="aboutme phone">
			    <h2>phone</h2>
				<p>+ 9 (012) 431 586 01</p>
			  </div>
			  <div class="aboutme">
			    <h2>about us</h2>
				<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. </p>
			  </div>
			</div>
			<div class="col-sm-9">		  
			     <div class="col-sm-12">
				   <div role="tabpanel">
				       <!-- Nav tabs -->
	                  <ul class="nav nav-tabs rank-list" role="tablist">
	                    <li role="presentation" class="active"><a href="#products" aria-controls="products" role="tab" data-toggle="tab">Products</a></li>
	                   <li role="presentation"><a href="#followers" aria-controls="followers" role="tab" data-toggle="tab">Followers</a></li>
		            </ul>
		             <div class="clearfix"></div>
					 <!-- Tab panes -->
					     <div class="tab-content business-cont">
					       <div role="tabpanel" class="tab-pane active" id="products">		
	                <div class="row">
	                    <div class="col-md-4 col-sm-6 col-xs-6 product">
	                    <div class="item item1">    
	                      <a href="#"><img alt="" src="images/image01.png"></a>
	                      <a href="#"><h4>Falken FK451 245/35R17<br>Summer tires</h4></a>
	                      <p>Commission <span>$ 24.96</span></p>
	                      <div class="row-inner">
	                        <div class="icon-right icon_right">
	                        <ul>
	                        <li><img alt="" src="images/recur1.jpg"></li>
	                       <li><img alt="" src="images/local.jpg"></li>
	                        <li><img alt="" src="images/global.jpg"></li>
	                        </ul>
	                      </div>
	                      <div class="clearfix"></div>
	                      </div>
	                      <div class="clearfix"></div>
	                      </div>
	                    </div>
	                    <div class="col-md-4 col-sm-6 col-xs-6 product">
	                    <div class="item item1">
	                     <a href="#"><img alt="" src="images/image02.png"></a>
	                      <a href="#"><h4>Falken FK451 245/35R17<br>Summer tires</h4></a>
	                      <p>Commission <span>$ 24.96</span></p>
	                      <div class="row-inner">
	                       <div class="icon-right icon_right">
	                        <ul>
	                        <li><img alt="" src="images/recur1.jpg"></li>
	                        <li><img alt="" src="images/local.jpg"></li>
	                        <li><img alt="" src="images/global.jpg"></li>
	                        </ul>
	                      </div>
	                      <div class="clearfix"></div>
	                      </div>
	                      <div class="clearfix"></div>
	                </div>
	                    </div>
	                    <div class="col-md-4 col-sm-6 col-xs-6 product">
	                    <div class="item item1">
	                     <a href="#"> <img alt="" src="images/image03.png"></a>
	                     <a href="#"><h4>Falken FK451 245/35R17<br>Summer tires</h4></a>
	                      <p>Commission <span>$ 24.96</span></p>
	                      <div class="row-inner">
	                        <div class="icon-right icon_right">
	                        <ul>
	                        <li><img alt="" src="images/recur1.jpg"></li>
	                        <li><img alt="" src="images/local.jpg"></li>
	                        <li><img alt="" src="images/global.jpg"></li>
	                        </ul>
	                      </div>
	                      <div class="clearfix"></div>
	                      </div>
	                      <div class="clearfix"></div>
	                      </div>
	                    </div>
	                   <div class="col-md-4 col-sm-6 col-xs-6 product">
	                    <div class="item item1">    
	                      <a href="#"><img src="images/image01.png" alt=""></a>
	                      <a href="#"><h4>Falken FK451 245/35R17<br>Summer tires</h4></a>
	                      <p>Commission <span>$ 24.96</span></p>
	                      <div class="row-inner">
	                        <div class="icon-right icon_right">
	                        <ul>
	                        <li><img src="images/recur1.jpg" alt=""></li>
	                       <li><img src="images/local.jpg" alt=""></li>
	                        <li><img src="images/global.jpg" alt=""></li>
	                        </ul>
	                      </div>
	                      <div class="clearfix"></div>
	                      </div>
	                      <div class="clearfix"></div>
	                      </div>
	                      </div>
	                    <div class="col-md-4 col-sm-6 col-xs-6 product">
	                    <div class="item item1">
	                     <a href="#"><img src="images/image02.png" alt=""></a>
	                      <a href="#"><h4>Falken FK451 245/35R17<br>Summer tires</h4></a>
	                      <p>Commission <span>$ 24.96</span></p>
	                      <div class="row-inner">
	                       <div class="icon-right icon_right">
	                        <ul>
	                        <li><img src="images/recur1.jpg" alt=""></li>
	                        <li><img src="images/local.jpg" alt=""></li>
	                        <li><img src="images/global.jpg" alt=""></li>
	                        </ul>
	                      </div>
	                      <div class="clearfix"></div>
	                      </div>
	                      <div class="clearfix"></div>
	                </div>
	                    </div>
	                    <div class="col-md-4 col-sm-6 col-xs-6 product">
	                    <div class="item item1">
	                     <a href="#"><img src="images/image03.png" alt=""></a>
	                     <a href="#"><h4>Falken FK451 245/35R17<br>Summer tires</h4></a>
	                      <p>Commission <span>$ 24.96</span></p>
	                      <div class="row-inner">
	                        <div class="icon-right icon_right">
	                        <ul>
	                        <li><img src="images/recur1.jpg" alt=""></li>
	                        <li><img src="images/local.jpg" alt=""></li>
	                        <li><img src="images/global.jpg" alt=""></li>
	                        </ul>
	                      </div>
	                      <div class="clearfix"></div>
	                      </div>
	                      <div class="clearfix"></div>
	                      </div>
	                    </div>  
	                </div>
	            </div><!--tab-panel1-->
						<div role="tabpanel" class="tab-pane" id="followers">
						 <div class="main-user-tab">
						  <div class="users">
								<div class="user-left">
								<a href="#"><img src="images/user1.png" alt=""/></a>
								</div>
								<div class="user-middle">
								  <a href="#"><h2>Kevin Hockney</h2></a>
								  <ul>
								   <li class="rank">Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li class="bordernone">Sales<span>124</span></li>
								  </ul>
								</div>
								<div class="user-right">
								  <a class="button5" href="#"><img src="images/add.png" alt=""/>add user</a>
								</div>
								<div class="clearfix"></div>
								</div>
								<hr>
								<div class="users1">
								<div class="user-left">
								<a href="#"><img src="images/user2.png" alt=""/></a>
								</div>
								<div class="user-middle">
								  <a href="#"><h2>John Ivanov</h2></a>
								  <ul>
								   <li class="rank">Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li class="bordernone">Sales<span>124</span></li>
								  </ul>
								</div>
								<div class="user-right">
								  <a class="button5" href="#"><img src="images/add.png" alt=""/>add user</a>
								</div>
								<div class="clearfix"></div>
								</div>
								<hr>
								<div class="users1">
								<div class="user-left">
								<a href="#"><img src="images/user3.png" alt=""/></a>
								</div>
								<div class="user-middle">
								 <a href="#"> <h2>Matt Simpson</h2></a>
								  <ul>
								   <li class="rank">Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li class="bordernone">Sales<span>124</span></li>
								  </ul>
								</div>
								<div class="user-right">
								  <a class="button5" href="#"><img src="images/add.png" alt=""/>add user</a>
								</div>
								<div class="clearfix"></div>
								</div>
								<hr>
								<div class="users1">
								<div class="user-left">
								<a href="#"><img src="images/user2.png" alt=""/></a>
								</div>
								<div class="user-middle">
								  <a href="#"><h2>John Hirst</h2></a>
								  <ul>
								   <li class="rank">Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li class="bordernone">Sales<span>124</span></li>
								  </ul>
								</div>
								<div class="user-right">
								  <a class="button5" href="#"><img src="images/add.png" alt=""/>add user</a>
								</div>
								<div class="clearfix"></div>
								</div>
								<hr>
								<div class="users1">
								<div class="user-left">
								<a href="#"><img src="images/user3.png" alt=""/></a>
								</div>
								<div class="user-middle">
								 <a href="#"> <h2>Alex Ivanov</h2></a>
								  <ul>
								   <li class="rank">Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li class="bordernone">Sales<span>124</span></li>
								  </ul>
								</div>
								<div class="user-right">
								  <a class="button5" href="#"><img src="images/add.png" alt=""/>add user</a>
								</div>
								<div class="clearfix"></div>
								</div>
								<hr>
								<div class="users1">
								<div class="user-left">
								<a href="#"><img src="images/user1.png" alt=""/></a>
								</div>
								<div class="user-middle">
								  <a href="#"><h2>Matt Simpson</h2></a>
								  <ul>
								   <li class="rank">Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li class="bordernone">Sales<span>124</span></li>
								  </ul>
								</div>
								<div class="user-right">
								  <a class="button5" href="#"><img src="images/add.png" alt=""/>add user</a>
								</div>
								<div class="clearfix"></div>
								</div>
								</div>
								</div><!--tab-panel2-->
					 </div><!--tab-content-->
				   </div><!--main-tab-panel-->			    					
				 </div><!--tab-box-->
			</div>
			<div class="clearfix"></div>
		  </div>
	   </div>
	</section>
@stop