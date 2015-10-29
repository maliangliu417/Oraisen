@extends('layouts.home_default')

@section('customStyles') 
   	{!! Html::style( 'css/timeline.css' ) !!}
   	{!! Html::style( 'css/timeline1.css' ) !!}
@stop

@section('styles')
<style type="text/css">
  .cd-content-in video{
    width:100%;
  }

  .map_canvas { width: 100%; height: 400px; }
  .post-dropdown{margin: 10px;}
  .like-lf .btn{
    background-color: #727A7E;
    border-color: #727A7E;
  }
  .post_edit, .post_delete{
    cursor:pointer;
  }
  textarea.post{
    border: 0px none;
    padding: 10px;
    resize: none;
    width: 100%;
    color: rgba(96, 108, 115, 0.8);
    font-size: 15px;
    line-height: 22px;
  }

</style>
@stop

@section('customHeaderScript')
  <script type="text/javascript" src="http://www.google.com/jsapi"></script>         
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js"></script>
  <script type="text/javascript" src="http://geoxml3.googlecode.com/svn/branches/polys/geoxml3.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
  
@stop

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

<style type="text/css">
  .form-label{
    text-align: right;
    font-size: 20px;
    text-transform: uppercase;
  }
  .form-text{
    font-size: 20px;
  }
  .form-text input{
    color: #333 !important;
    background-color: rgb(140, 221, 251) !important;
  }
  .form-submit{
    margin-top: 20px;
  }
  .form-submit input{
    display: block;
    margin: 0 auto;
    width: 100px;
    font-size: 20px;
    background-color: #fcb562;
    border: 1px solid #fcb562;
    border-radius: 3px;

  }
  .form-submit input:hover{
    background-color: #9cfc62;
  }
</style>

@section('pageContainer')
<input type="hidden" value="{!! $user->usrRememberToken !!}" id="profile-token"> 
<section class="parallax-main parallax-main1">
   <div class="prlx prlx-7"></div><!--parallax-->
 </section>
 <section class="profile-top">
    <div class="container1">
   <div class="row pro-descp">
   <div class="col-sm-6 profilelf">   
    <div class="row">
    <div class="col-xs-4 prof-left">
      <div class="profile-main">{!! Html::image($user->accImgUrl, 'picture') !!}</div>
    </div>
    <div class="col-xs-8 profile-text">
      <h2>{!! $user->usrFrsName!!} {!! $user->usrLstName!!}</h2>
      <a href="#"><h4>{!! $user->email !!}</h4></a>
      <h5>{!! Html::image("images/business-icon.png", 'picture') !!}{!! $user->usrPermission !!}</h5>
    </div>
    <div class="clearfix"></div>
    </div><!--row-->
   </div>
   <div class="col-sm-6">
      <div class="search-main">
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
      <div class="col-sm-3">
      @if($boolCheckFriend == false)
      <a class="button3 add-user" href="" data-toggle="modal" data-target="#friendModal">{!! Html::image("images/add.png", 'picture') !!} 
        <span class="request-status">    
            add user
        </span>
      </a>
      @endif
      <a class="button3 button4" href="{!! url('mail') !!}">{!! Html::image("images/mail.png", 'picture') !!}send message</a>
      <div class="web">
         <span>On the web</span>
        <ul class="icons-new">
          <li><a href="/">{!! Html::image("images/facebook.png", 'picture') !!}</a></li>
        <li><a href="/">{!! Html::image("images/twit.png", 'picture') !!}</a></li>
        <li><a href="/">{!! Html::image("images/google.png", 'picture') !!}</a></li>
       </ul>
       <div class="clearfix"></div>
      </div>
      <div class="ranking">
        <ul>
      <li><span>Overall Ranking</span>{!! $user->accOverallRangking !!}</li>
      <li><span>State Ramking</span>{!! $user->accStateRangking !!}</li>
      <li><span>sales</span>0</li>
      </ul>
      <div class="clearfix"></div>
      </div>
      <div class="aboutme">
        <h2>about me</h2>
        <p class="about-me1">
          Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. 
        </p>
      </div>
    </div>
    <div class="col-sm-9">  
         <div class="dashboard-tab2 user-profile">
               <ul role="tablist" class="nav nav-tabs">
               <li class="active product-tab" role="presentation"><a data-toggle="tab" role="tab" aria-controls="timeline" href="#timeline"><span>Timeline</span></a></li>
               <li class="product-tab" role="presentation">
               <a data-toggle="tab" role="tab" aria-controls="addedusers" href="#addedusers">
               <span>Friends</span><div class="product-tab_1">{!! sizeof($friends) !!}</div></a></li>
               <li class="product-tab" role="presentation">
               <a data-toggle="tab" role="tab" aria-controls="following" href="#following">
               <span>Favorites</span><div class="product-tab_1">17</div></a></li>               
             </ul>
         <!-- Tab panes -->
         <div class="tab-content">
         @if($boolAuth == true)
             <div role="tabpanel" class="tab-pane active" id="timeline">
                <div class="status">
                  <textarea placeholder="What’s up today?" id="post-content"></textarea>
                  <ul>
                    <li class="photo"><a class="active" href="{!! url('upload/photo/'.$user->usrName) !!}"></a></li>
                    <li class="video"><a href="{!! url('upload/video/'.$user->usrName) !!}"></a></li>
                    <li class="location"><a href="{!! url('upload/location/'.$user->usrName) !!}"></a></li>
                  </ul>
                  <a href="#" class="post-info">Post Status</a>
                </div>
                <section id="cd-timeline">

                    @foreach($timeline_data as $index => $data)
                      <div class="cd-timeline-block cd-timeline-block1">
                        <div class="cd-timeline-img cd-movie">
                            {!! Html::image($data['type_img'], 'picture') !!}
                        </div> <!-- cd-timeline-img -->

                        <div class="cd-timeline-content">
                          <div class="cd-content-in cd-content-in1">
                            @if($data['type'] == 0)
                              <textarea class="post about-me-{!! $data['tlnId'] !!}" readonly>{!! $data['url'] !!}</textarea>  
                            @elseif($data['type'] == 2)
                              <video  controls>
                                <source src="{!! url($data['url']) !!}" type="video/mp4">
                                <source src="{!! url($data['url']) !!}" type="video/ogg">
                                <source src="{!! url($data['url']) !!}" type="video/webm">
                              </video> 
                            @elseif($data['type'] == 3)
                              <div id="map_canvas{!! $index !!}" class="map_canvas"></div>
                                <!--Google Map-->
                                <script type="text/javascript">
                                  function getLocation(){
                                    
                                    var infoWindowContent = "zipcode : {!! $data['url'] !!}";
                                    var zipcode = "{!! $data['url'] !!}";
                                    var map_canvas = 'map_canvas';
                                    map_canvas += '{!! $index !!}';
                                        
                                    var map = new google.maps.Map(document.getElementById(map_canvas), {
                                          center: new google.maps.LatLng(52.5167, 12.1833),
                                          zoom:   6
                                      });
                                       var geocoder = new google.maps.Geocoder();
                                       var infowindow = new google.maps.InfoWindow();
                                      var markers = new Array();

                                      geocoder.geocode({
                                          address: zipcode,
                                          region: 'DE'
                                      }, function(result, status) {
                                          if (status == 'OK' && result.length > 0) {
                                              marker = new google.maps.Marker({ 
                                                  position: result[0].geometry.location,
                                                  map: map,
                                                  title: 'Click Me',
                                              });

                                              google.maps.event.addListener(marker, 'click', function() {
                                                infowindow.setContent(infoWindowContent);
                                                infowindow.open(map,marker);
                                              });

                                              map.setCenter(marker.getPosition()); 
                                          }
                                          
                                      });           

                                  }

                                  

                                  google.maps.event.addDomListener(window, 'load', getLocation);

                                  </script>
                            @else
                              {!! Html::image($data['url'], 'picture') !!}
                            @endif                           
                          </div>
                          <div class="like">
                            <div class="like-lf">
                              <p><span><a href="#"><i class="fa fa-heart"></i></a></span><span>
                                  {!! $data['favor_number'] !!}
                              </span></p>
                            </div>
                            <div class="like-lf post-dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                @if($data['type'] == 0)
                                  <li><a id="post_edit_{!! $data['tlnId'] !!}" class="post_edit" data-toggle="modal" data-target="#myModal">Edit</a></li>
                                @elseif($data['type'] == 2)
                                  <li><a id="post_edit_{!! $data['tlnId'] !!}" class="post_edit">Edit</a></li>
                                @elseif($data['type'] == 3)
                                  <li><a id="post_edit_{!! $data['tlnId'] !!}" class="post_edit">Edit</a></li>
                                @else
                                  <li><a id="post_edit_{!! $data['tlnId'] !!}" class="post_edit">Edit</a></li>
                                @endif
                                <li><a id="post_delete_{!! $data['tlnId'] !!}" class="post_delete">Delete</a></li>
                              </ul>                
                            </div>
                            <div class="like-lf like-rt">
                              <p><span><i class="fa fa-clock-o"></i></span><span>
                                  {!! $data['date'] !!}
                              </span></p>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          
                        </div> <!-- cd-timeline-content -->
                        <div class="clearfix"></div>
                      </div> <!-- cd-timeline-block -->
                    @endforeach

                </section>
             </div>
         @endif
            <div role="tabpanel" class="tab-pane" id="addedusers">              
             <div class="row">

                @foreach($friends as $fri)
                   <div class="col-md-6 col-sm-12">
                      <div class="added-user">
                           <div class="invoice-lf added-user-lf">
                           <a href="/">{!! Html::image($fri->accImgUrl, 'picture') !!}</a>
                           </div>           
                          <div class="invoice-middle added-user-mid">
                            <a href="/"><h2>{!! $fri->usrFrsName !!} {!! $fri->usrLstName !!}</h2></a>
                            <ul>
                             <li>Ranking<span>{!! $fri->accOverallRangking !!}</span></li>
                             <li>State Ranking<span>{!! $fri->accStateRangking !!}</span></li>
                            </ul>
                          </div>
                         </div>
                   </div> 
                 @endforeach
                 
               </div>
             <div class="loadmore">
                 <a href="#"><p><span>{!! Html::image("images/loadmore.png", 'picture') !!}</span> Load More</p></a>
             </div> 
          </div><!--tab-panel1-->
          <div role="tabpanel" class="tab-pane" id="following">
               <div class="row">
              <div class="col-md-6 col-sm-12">
                 <div class="added-user">
               <div class="invoice-lf added-user-lf">
               <a href="/">{!! Html::image("images/notification01.jpg", 'picture') !!}</a>
               </div>            
              <div class="invoice-middle added-user-mid">
                <a href="/"><h2>KTM Bikes in Germany</h2></a>
                <ul>
                 <li>Ranking<span>153</span></li>
                 <li>State Ranking<span>105</span></li>
                </ul>
              </div>
             </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="added-user">
               <div class="invoice-lf added-user-lf">
               <a href="/">{!! Html::image("images/notification02.jpg", 'picture') !!}</a>
               </div>            
              <div class="invoice-middle added-user-mid">
                <a href="/"><h2>Giant</h2></a>
                <ul>
                 <li>Ranking<span>153</span></li>
                 <li>State Ranking<span>105</span></li>
                </ul>
              </div>
             </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="added-user">
               <div class="invoice-lf added-user-lf">
               <a href="/">{!! Html::image("images/notification04.jpg", 'picture') !!}</a>
               </div>            
              <div class="invoice-middle added-user-mid">
                <a href="/"><h2>Yamaha LTD</h2></a>
                <ul>
                 <li>Ranking<span>153</span></li>
                 <li>State Ranking<span>105</span></li>
                </ul>
              </div>
             </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="added-user">
               <div class="invoice-lf added-user-lf">
               <a href="/">{!! Html::image("images/notification05.jpg", 'picture') !!}</a>
               </div>            
              <div class="invoice-middle added-user-mid">
                <a href="/"><h2>Logitech</h2></a>
                <ul>
                 <li>Ranking<span>153</span></li>
                 <li>State Ranking<span>105</span></li>
                </ul>
              </div>
             </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="added-user">
               <div class="invoice-lf added-user-lf">
               <a href="/">{!! Html::image("images/notification03.jpg", 'picture') !!}</a>
               </div>            
              <div class="invoice-middle added-user-mid">
                <a href="/"><h2>Smart</h2></a>
                <ul>
                 <li>Ranking<span>153</span></li>
                 <li>State Ranking<span>105</span></li>
                </ul>
              </div> 
              </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="added-user">
               <div class="invoice-lf added-user-lf">
               <a href="/">{!! Html::image("images/notification02.jpg", 'picture') !!}</a>
               </div>            
              <div class="invoice-middle added-user-mid">
                <a href="/"><h2>Giant</h2></a>
                <ul>
                 <li>Ranking<span>153</span></li>
                 <li>State Ranking<span>105</span></li>
                </ul>
              </div>
              </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="added-user">
               <div class="invoice-lf added-user-lf">
               <a href="/">{!! Html::image("images/notification04.jpg", 'picture') !!}</a>
               </div>            
              <div class="invoice-middle added-user-mid">
                <a href="/"><h2>Yamaha LTD</h2></a>
                <ul>
                 <li>Ranking<span>153</span></li>
                 <li>State Ranking<span>105</span></li>
                </ul>
              </div>
              </div>
              </div>
              <div class="col-md-6 col-sm-12">
                 <div class="added-user">
               <div class="invoice-lf added-user-lf">
               <a href="/">{!! Html::image("images/notification05.jpg", 'picture') !!}</a>
               </div>            
              <div class="invoice-middle added-user-mid">
                <a href="/"><h2>Logitech</h2></a>
                <ul>
                 <li>Ranking<span>153</span></li>
                 <li>State Ranking<span>105</span></li>
                </ul>
              </div>
             </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="added-user">
                 <div class="invoice-lf added-user-lf">
                  <a href="/">{!! Html::image("images/notification03.jpg", 'picture') !!}</a>
                  </div>            
                  <div class="invoice-middle added-user-mid">
                    <a href="/"><h2>Smart</h2></a>
                    <ul>
                     <li>Ranking<span>153</span></li>
                     <li>State Ranking<span>105</span></li>
                    </ul>
                  </div>
                 </div>
              </div>
               <div class="col-md-6 col-sm-12">
                <div class="added-user">
               <div class="invoice-lf added-user-lf">
               <a href="/">{!! Html::image("images/notification02.jpg", 'picture') !!}</a>
               </div>            
              <div class="invoice-middle added-user-mid">
                <a href="/"><h2>Giant</h2></a>
                <ul>
                 <li>Ranking<span>153</span></li>
                 <li>State Ranking<span>105</span></li>
                </ul>
              </div>
              </div>
              </div>
             </div>
            <!--row end-->            
             <div class="loadmore">
                 <a href="#"><p><span>{!! Html::image("images/loadmore.png", 'picture') !!}</span> Load More</p></a>
             </div>
             </div>
          <!--tab-panel2-->
         </div><!--tab-content-->                 
       </div><!--tab-box-->
    </div>
    <div class="clearfix"></div>
    </div>
   </div>
</section>
<div class="products-modelbox">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        <button type="button" class="closediv" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                <div class="tire-text">
                  <h1>Post Edit</h1>
                </div>
              </div>
              <div class="col-sm-12">
                <textarea id="post-edit-content"></textarea>
              </div>
              <div class="col-sm-12">
                <div class="referral-box">
                  <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                  <button type="button" id="post-edit-done">Edit</button>                   
                </div>
              </div>
            </div>           
          </div>
       
        </div>
      </div>
    </div>
  </div>
<style type="text/css">
  #post-edit-content{
    width: 100%;
    height: 300px;
  }
</style>
@stop

@section('customFooterScript')

{!! Html::script( 'js/jquery.js' ) !!}

{!! Html::script( 'js/jquery.validate.js' ) !!}

{!! Html::script( 'js/profile.js' ) !!}

@stop

@section('footerJavascript')
  <script type="text/javascript">
    
  </script>
@stop
