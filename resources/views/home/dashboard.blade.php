@extends('layouts.home_default')

@section('styles')
	<style type="text/css">
		#map_canvas { width: 100%; height: 400px; }
		.dashboard-cont .close{
			font-size: 20px;
		}
	</style>
@stop

@section('customHeaderScript')
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>         
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js"></script>
	<script type="text/javascript" src="http://geoxml3.googlecode.com/svn/branches/polys/geoxml3.js"></script>
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

	<!--Google Map-->
	<script type="text/javascript">
		function getLocation(){
			var postalCodes = [
			    '01067', // Dresden
			    '10405', // Berlin
			];
			var infoWindowContent = [
		        ['<div class="info_content">' +
		        '<h3>London Eye</h3>' +
		        '<p>The London Eye is a giant Ferris wheel situated on the banks of the River Thames. The entire structure is 135 metres (443 ft) tall and the wheel has a diameter of 120 metres (394 ft).</p>' +        '</div>'],
		        ['<div class="info_content">' +
		        '<h3>Palace of Westminster</h3>' +
		        '<p>The Palace of Westminster is the meeting place of the House of Commons and the House of Lords, the two houses of the Parliament of the United Kingdom. Commonly known as the Houses of Parliament after its tenants.</p>' +
		        '</div>']
		    ];
			var map = new google.maps.Map(document.getElementById('map_canvas'), {
		        center: new google.maps.LatLng(52.5167, 12.1833),
		        zoom:   6
		    });
		     var geocoder = new google.maps.Geocoder();
		     var infowindow = new google.maps.InfoWindow();
		    var markers = new Array();

			for (i = 0; i < postalCodes.length; ++i) {
		            geocoder.geocode({
		                address: postalCodes[i],
		                region: 'DE'
		            }, function(result, status) {
		                if (status == 'OK' && result.length > 0) {
		                    marker = new google.maps.Marker({	
		                        position: result[0].geometry.location,
		                        map: map,
		                        title: 'd',
		                    });

		                    markers.push(marker);
		                    if(markers.length == postalCodes.length){
		                    	for(j=0;j<markers.length;j++){
		                    		var marker_unit = markers[j];
		                    		google.maps.event.addListener(marker_unit, 'click', (function(marker_unit, j) {
								        return function() {
								          infowindow.setContent(infoWindowContent[j][0]);
								          infowindow.open(map, marker_unit);
								        }
								      })(marker_unit, j));
		                    	}
		                    }
		                }
		                
		            });

		            
		        }
		}

		

		google.maps.event.addDomListener(window, 'load', getLocation);

    </script>
	<!--Google Map End-->
	<script type="text/javascript" >
		$(document).ready(function(){
		$(".menu-drop1 i").click(function(){
		  $(this).parent(".menu-drop1").addClass("searchmain")
		});
		});
	</script>
@stop

@section('pageContainer')
	@if($signup == true && $user->usrConfirmed == 0)
		<script type="text/javascript">
			$(document).ready(function(){
				alert('Welcome signup! Please check your email for verification!');
			});
		</script>
	@endif

	<section class="dashboard">
	  <div class="container1">
	    <div class="dashboard-cont">
	      <h2>Dashboard</h2>
	      @if ( !is_null(Session::get('permission_status')) )
            <div class="alert alert-success alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">
                   ×
                </button>
                <i class="fa fa-check-circle"></i><strong> Remember!</strong>
                @if (is_array(Session::get('permission_status')))
                <ul>
                    @foreach (Session::get('permission_status') as $success)
                    <li>
                        {{ $success }}
                    </li>
                    @endforeach
                </ul>
                @else
                {{ Session::get('permission_status') }}
                @endif
            </div>
        @endif
	      <div class="dashboard-inner">
	      <div class="dashboard-profile">
	        <div class="row">
	          <div class="col-md-4 dashboard-lf">
	            <div class="row">
	            	<div class="col-xs-6"><img src="{!! $account->accImgUrl !!}" alt=""/></div>
				 	<div class="col-xs-6 dashboard-cont-lf">
		            <h2>{!! $user->usrFrsName !!} {!! $user->usrLstName !!}</h2>
		            <p>Marketer level<span>1</span></p>
		            </div>
	            </div>	            
	          </div>
	          <div class="col-md-8 dashboard-rt">
	            <div class="row">
	              <div class="col-xs-4">                
	                <h2><img src="images/ranking-icon.png" alt=""/>{!! $account->accOverallRangking !!}<span>Ranking</span></h2>
	              </div>
	              <div class="col-xs-4">
	                <h2><img src="images/earning-icon.png" alt=""/>
	                	@if($account->accProductId == 0)
	                		$0.00
	                	@endif
	                	<span>
	                		Overall Earnings
	                	</span></h2>
	              </div>
	              <div class="col-xs-4">
	                <h2><img src="images/referal-icon.png" alt=""/>
	                	@if($account->accFriends == '')
	                		0
	                	@endif
	                	<span>
	                		Refferals
	                	</span></h2>
	              </div>
	            </div>
	          </div>          
	        </div>
	        <!--row end-->
	      </div>
	      <!--dashboard profile end-->
	  <div class="dashboard-tabs">
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs dashboard-tab1" role="tablist">
	    <li role="presentation" class="map-tab active"><a href="#map" aria-controls="map" role="tab" data-toggle="tab">
	    <div class="map-tab_1"></div><span>Map</span></a></li>
	    <li role="presentation" class="map-tab"><a href="#graph" aria-controls="graph" role="tab" data-toggle="tab">
	    <div class="map-tab_1 map-tab_2"></div><span>Graph</span></a></li>
	  </ul>

	  <!-- Tab panes -->
	  <div class="tab-content">
	    <div role="tabpanel" class="tab-pane active" id="map">
	      <div class="map">
	        <div id="map_canvas"></div>
	      </div>
	    </div>
	    <div role="tabpanel" class="tab-pane graph-box" id="graph">
	      <div class="graph-cont">
	         <ul class="nav nav-tabs dashboard-tab-in" role="tablist">
	               <li role="presentation" class="active graph-tab"><a href="#sales" aria-controls="sales" role="tab" data-toggle="tab"><div class="graph-tab_1"></div><span>Sales</span></a></li>
	               <li role="presentation" class="graph-tab"><a href="#visitor" aria-controls="visitor" role="tab" data-toggle="tab">
	               <div class="graph-tab_1 graph-tab_2"></div><span>Visitors</span></a></li>
	               <li role="presentation" class="graph-tab"><a href="#clicks" aria-controls="clicks" role="tab" data-toggle="tab">
	               <div class="graph-tab_1 graph-tab_3"></div><span>Clicks</span></a></li>
	               <li role="presentation" class="graph-tab"><a href="#earnings" aria-controls="earnings" role="tab" data-toggle="tab"><div class="graph-tab_1 graph-tab_4"></div><span>earnings</span></a></li>
	             </ul>
	              <div class="select-statistic">
	      <span class="select-wrapper4"><select class="custom-select4" name="tempx123">
	        <option>Last 30 days</option>
	        <option>dummy text1</option>
	        <option>dummy text2</option>
	        <option>dummy text3</option>
	      </select><span class="holder">Last 30 days</span></span>
	    </div>
	             <div class="tab-content">
	              <div role="tabpanel" class="tab-pane active" id="sales">
	                <div class="graph-img">
	                  <img src="images/graph.png" alt=""/>
	                </div>
	              </div>
	              <div role="tabpanel" class="tab-pane" id="visitor">
	                <div class="graph-img">
	                  <img src="images/graph.png" alt=""/>
	                </div>
	              </div>
	              <div role="tabpanel" class="tab-pane" id="clicks">
	                <div class="graph-img">
	                  <img src="images/graph.png" alt=""/>
	                </div>
	              </div>
	              <div role="tabpanel" class="tab-pane" id="earnings">
	                <div class="graph-img">
	                  <img src="images/graph.png" alt=""/>
	                </div>
	              </div>

	      </div>
	    </div>
	   
	  </div>
	</div>
	<!--dashboard tabs end-->
	   <div class="dashboard-content"> 
	       <div class="dashboard-tab2">
	          <ul class="nav nav-tabs" role="tablist">
	               <li role="presentation" class="active  product-tab"><a href="#products" aria-controls="products" role="tab" data-toggle="tab"><span>My Products</span><div class="product-tab_1">109</div></a></li>
	               <li role="presentation" class="product-tab">
	               <a href="#referal" aria-controls="referal" role="tab" data-toggle="tab">
	               <span>Referrals</span><div class="product-tab_1">8</div></a></li>
	               <li role="presentation" class="product-tab">
	               <a href="#invoice" aria-controls="invoice" role="tab" data-toggle="tab">
	               <span>Pending invoices</span><div class="product-tab_1">54</div></a></li>               
	             </ul>
	              <div class="tab-content">
	              <div role="tabpanel" class="tab-pane active" id="products">           
	                   <div class="table-data">
	                     <table id="tableData">
	                      <tbody>
	                        <tr>
	                          <td>
	                            <div class="table-cont">
	                              <img src="images/sale01.jpg" alt=""/>
	                              <h3>Hankook Optimo H724 All-Season</h3>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 24.96</span>Comission</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 3.082</span>Earned</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span>124</span>Sales </p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span><a href="#"><i class="fa fa-trash-o"></i></a></span>Remove</p>
	                            </div>
	                          </td>
	                        </tr>
	                          <tr>
	                          <td>
	                            <div class="table-cont">
	                              <img src="images/sale02.jpg" alt=""/>
	                              <h3>Goodyear Eagle LS Radial Tire - 205/55R16 </h3>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 24.96</span>Comission</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 3.082</span>Earned</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span>124</span>Sales </p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span><a href="#"><i class="fa fa-trash-o"></i></a></span>Remove</p>
	                            </div>
	                          </td>
	                        </tr>
	                        <tr>
	                          <td>
	                            <div class="table-cont">
	                              <img src="images/sale03.jpg" alt=""/>
	                              <h3>Hankook Optimo H724 All-Season Tire<br/>235/75R15 108S</h3>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 24.00</span>Comission</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 82</span>Earned</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span>2</span>Sales </p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span><a href="#"><i class="fa fa-trash-o"></i></a></span>Remove</p>
	                            </div>
	                          </td>
	                        </tr>
	                        <tr>
	                          <td>
	                            <div class="table-cont">
	                              <img src="images/sale04.jpg" alt=""/>
	                              <h3>Goodyear Eagle LS Radial Tire - 205/55R16 </h3>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 24.96</span>Comission</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 3.082</span>Earned</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span>124</span>Sales </p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span><a href="#"><i class="fa fa-trash-o"></i></a></span>Remove</p>
	                            </div>
	                          </td>
	                        </tr>
	                        <tr>
	                          <td>
	                            <div class="table-cont">
	                              <img src="images/sale05.jpg" alt=""/>
	                              <h3>Falken FK451 245/35R17</h3>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 24.96</span>Comission</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont zero">
	                              <p><span>0</span>Earned</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale zero">
	                              <p><span>0</span>Sales </p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span><a href="#"><i class="fa fa-trash-o"></i></a></span>Remove</p>
	                            </div>
	                          </td>
	                        </tr>
	                        <tr>
	                          <td>
	                            <div class="table-cont">
	                              <img src="images/sale01.jpg" alt=""/>
	                              <h3>Hankook Optimo H724 All-Season</h3>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 24.96</span>Comission</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 3.082</span>Earned</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span>124</span>Sales </p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span><a href="#"><i class="fa fa-trash-o"></i></a></span>Remove</p>
	                            </div>
	                          </td>
	                        </tr>
	                          <tr>
	                          <td>
	                            <div class="table-cont">
	                              <img src="images/sale02.jpg" alt=""/>
	                              <h3>Goodyear Eagle LS Radial Tire - 205/55R16 </h3>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 24.96</span>Comission</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 3.082</span>Earned</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span>124</span>Sales </p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span><a href="#"><i class="fa fa-trash-o"></i></a></span>Remove</p>
	                            </div>
	                          </td>
	                        </tr>
	                        <tr>
	                          <td>
	                            <div class="table-cont">
	                              <img src="images/sale03.jpg" alt=""/>
	                              <h3>Hankook Optimo H724 All-Season Tire<br/>235/75R15 108S</h3>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 24.00</span>Comission</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 82</span>Earned</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span>2</span>Sales </p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span><a href="#"><i class="fa fa-trash-o"></i></a></span>Remove</p>
	                            </div>
	                          </td>
	                        </tr>
	                        <tr>
	                          <td>
	                            <div class="table-cont">
	                              <img src="images/sale04.jpg" alt=""/>
	                              <h3>Goodyear Eagle LS Radial Tire - 205/55R16 </h3>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 24.96</span>Comission</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 3.082</span>Earned</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span>124</span>Sales </p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span><a href="#"><i class="fa fa-trash-o"></i></a></span>Remove</p>
	                            </div>
	                          </td>
	                        </tr>
	                        <tr>
	                          <td>
	                            <div class="table-cont">
	                              <img src="images/sale05.jpg" alt=""/>
	                              <h3>Falken FK451 245/35R17</h3>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 24.96</span>Comission</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont zero">
	                              <p><span>0</span>Earned</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale zero">
	                              <p><span>0</span>Sales </p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span><a href="#"><i class="fa fa-trash-o"></i></a></span>Remove</p>
	                            </div>
	                          </td>
	                        </tr>
	                        <!--second row end-->
	                        <tr>
	                          <td>
	                            <div class="table-cont">
	                              <img src="images/sale01.jpg" alt=""/>
	                              <h3>Hankook Optimo H724 All-Season</h3>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 24.96</span>Comission</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 3.082</span>Earned</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span>124</span>Sales </p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span><a href="#"><i class="fa fa-trash-o"></i></a></span>Remove</p>
	                            </div>
	                          </td>
	                        </tr>
	                          <tr>
	                          <td>
	                            <div class="table-cont">
	                              <img src="images/sale02.jpg" alt=""/>
	                              <h3>Goodyear Eagle LS Radial Tire - 205/55R16 </h3>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 24.96</span>Comission</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 3.082</span>Earned</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span>124</span>Sales </p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span><a href="#"><i class="fa fa-trash-o"></i></a></span>Remove</p>
	                            </div>
	                          </td>
	                        </tr>
	                        <tr>
	                          <td>
	                            <div class="table-cont">
	                              <img src="images/sale03.jpg" alt=""/>
	                              <h3>Hankook Optimo H724 All-Season Tire<br/>235/75R15 108S</h3>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 24.00</span>Comission</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 82</span>Earned</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span>2</span>Sales </p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span><a href="#"><i class="fa fa-trash-o"></i></a></span>Remove</p>
	                            </div>
	                          </td>
	                        </tr>
	                        <tr>
	                          <td>
	                            <div class="table-cont">
	                              <img src="images/sale04.jpg" alt=""/>
	                              <h3>Goodyear Eagle LS Radial Tire - 205/55R16 </h3>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 24.96</span>Comission</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 3.082</span>Earned</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span>124</span>Sales </p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span><a href="#"><i class="fa fa-trash-o"></i></a></span>Remove</p>
	                            </div>
	                          </td>
	                        </tr>
	                         <tr>
	                          <td>
	                            <div class="table-cont">
	                              <img src="images/sale05.jpg" alt=""/>
	                              <h3>Falken FK451 245/35R17</h3>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont">
	                              <p><span>$ 24.96</span>Comission</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont zero">
	                              <p><span>0</span>Earned</p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale zero">
	                              <p><span>0</span>Sales </p>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="table-cont sale">
	                              <p><span><a href="#"><i class="fa fa-trash-o"></i></a></span>Remove</p>
	                            </div>
	                          </td>
	                        </tr>                   
	                      </tbody>
	                     </table>
	                   </div>
	              </div>
	           <div role="tabpanel" class="tab-pane" id="referal">
				     <div class="referal-table">
					   <table>
					     <tbody>
					     <tr>
						   <td>
						     <table>
							   <tr>
							     <td>
								     <div class="referal-cont">
									   <img src="images/message01.jpg" alt=""/>
									   <h2>Matt<br/>Simpson </h2>
								   </div>
								 </td>
								 <td>
								   <div class="table-cont">
	                              <p><span>124</span>Sales</p>
	                            </div>
								 </td>
								 <td>
								   <div class="table-cont">
	                              <p><span>3.082 $ </span>Earned </p>
	                            </div>
								 </td>
							   </tr>
							 </table>
						   </td>
						   <td>
						     <table>
							   <tr>
							     <td>
								     <div class="referal-cont">
									   <img src="images/message06.jpg" alt=""/>
									   <h2>Bryan<br/>Hockney </h2>
								   </div>
								 </td>
								 <td>
								   <div class="table-cont">
	                              <p><span>124</span>Sales</p>
	                            </div>
								 </td>
								 <td>
								   <div class="table-cont">
	                              <p><span>3.082 $ </span>Earned </p>
	                            </div>
								 </td>
							   </tr>
							 </table>
						   </td>
						 </tr>
						 <tr>
						   <td>
						     <table>
							   <tr>
							     <td>
								     <div class="referal-cont">
									   <img src="images/message03.jpg" alt=""/>
									   <h2>Kevin<br/>Hockney </h2>
								   </div>
								 </td>
								 <td>
								   <div class="table-cont">
	                              <p><span>124</span>Sales</p>
	                            </div>
								 </td>
								 <td>
								   <div class="table-cont">
	                              <p><span>3.082 $ </span>Earned </p>
	                            </div>
								 </td>
							   </tr>
							 </table>
						   </td>
						   <td>
						     <table>
							   <tr>
							     <td>
								     <div class="referal-cont">
									   <img src="images/message02.jpg" alt=""/>
									   <h2>Natasha<br/>Brown</h2>
								   </div>
								 </td>
								 <td>
								   <div class="table-cont">
	                              <p><span>124</span>Sales</p>
	                            </div>
								 </td>
								 <td>
								   <div class="table-cont">
	                              <p><span>3.082 $ </span>Earned </p>
	                            </div>
								 </td>
							   </tr>
							 </table>
						   </td>
						 </tr>
						  <tr>
						   <td>
						     <table>
							   <tr>
							     <td>
								     <div class="referal-cont">
									   <img src="images/message05.jpg" alt=""/>
									   <h2>Marina<br/>Abramovich </h2>
								   </div>
								 </td>
								 <td>
								   <div class="table-cont">
	                              <p><span>124</span>Sales</p>
	                            </div>
								 </td>
								 <td>
								   <div class="table-cont">
	                              <p><span>3.082 $ </span>Earned </p>
	                            </div>
								 </td>
							   </tr>
							 </table>
						   </td>
						   <td>
						     <table>
							   <tr>
							     <td>
								     <div class="referal-cont">
									   <img src="images/message04.jpg" alt=""/>
									   <h2>Daniel<br/>Jackson</h2>
								   </div>
								 </td>
								 <td>
								   <div class="table-cont">
	                              <p><span>124</span>Sales</p>
	                            </div>
								 </td>
								 <td>
								   <div class="table-cont">
	                              <p><span>3.082 $ </span>Earned </p>
	                            </div>
								 </td>
							   </tr>
							 </table>
						   </td>
						 </tr>
						 <tr>
						   <td>
						     <table>
							   <tr>
							     <td>
								     <div class="referal-cont">
									   <img src="images/message05.jpg" alt=""/>
									   <h2>Marina<br/>Abramovich </h2>
								   </div>
								 </td>
								 <td>
								   <div class="table-cont">
	                              <p><span>124</span>Sales</p>
	                            </div>
								 </td>
								 <td>
								   <div class="table-cont">
	                              <p><span>3.082 $ </span>Earned </p>
	                            </div>
								 </td>
							   </tr>
							 </table>
						   </td>
						   <td>
						     <table>
							   <tr>
							     <td>
								     <div class="referal-cont">
									   <img src="images/message04.jpg" alt=""/>
									   <h2>Daniel<br/>Jackson</h2>
								   </div>
								 </td>
								 <td>
								   <div class="table-cont">
	                              <p><span>124</span>Sales</p>
	                            </div>
								 </td>
								 <td>
								   <div class="table-cont">
	                              <p><span>3.082 $ </span>Earned </p>
	                            </div>
								 </td>
							   </tr>
							 </table>
						   </td>
						 </tr>
						 </tbody>
					   </table>
					 </div>
				  </div>
	        <div role="tabpanel" class="tab-pane" id="invoice">
				    <div class="table-data1">
					<table id="tableData1">
					  <tbody>
					    <tr>
						  <td>
						    <div class="invoice-lf">
								 <a href="/"><img alt="" src="images/notification01.jpg"></a>
								 </div>
						  </td>
						  <td>
						    <div class="invoice-middle">
								  <a href="/"><h2>KTM Bikes in Germany</h2></a>
								  <ul>
								   <li>Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li>Sales<span>124</span></li>
								  </ul>
								</div>
						  </td>
						  <td>
						   <div class="invoice-rt">
						    <a href="#">
						     <div class="invoice-in">
							   <img src="images/mail-user.png" alt=""/>
							 </div>
						   Sent invoice
						   </a>
						   </div>
						  </td>
						</tr>
						<tr>
						  <td>
						    <div class="invoice-lf">
								 <a href="/"><img alt="" src="images/notification02.jpg"></a>
								 </div>
						  </td>
						  <td>
						    <div class="invoice-middle">
								  <a href="/"><h2>Giant</h2></a>
								  <ul>
								   <li>Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li>Sales<span>124</span></li>
								  </ul>
								</div>
						  </td>
						  <td>
						     <div class="invoice-rt">
						    <a href="#">
						     <div class="invoice-in">
							   <img src="images/mail-user.png" alt=""/>
							 </div>
						   Sent invoice
						   </a>
						   </div>
						  </td>
						</tr>
						<tr>
						  <td>
						    <div class="invoice-lf">
								 <a href="/"><img alt="" src="images/notification04.jpg"></a>
								 </div>
						  </td>
						  <td>
						    <div class="invoice-middle">
								  <a href="/"><h2>Yamaha LTD</h2></a>
								  <ul>
								   <li>Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li>Sales<span>124</span></li>
								  </ul>
								</div>
						  </td>
						  <td>
						     <div class="invoice-rt">
						    <a href="#">
						     <div class="invoice-in">
							   <img src="images/mail-user.png" alt=""/>
							 </div>
						   Sent invoice
						   </a>
						   </div>
						  </td>
						</tr>
						<tr>
						  <td>
						    <div class="invoice-lf">
								 <a href="/"><img alt="" src="images/notification05.jpg"></a>
								 </div>
						  </td>
						  <td>
						    <div class="invoice-middle">
								  <a href="/"><h2>Logitech</h2></a>
								  <ul>
								   <li>Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li>Sales<span>124</span></li>
								  </ul>
								</div>
						  </td>
						  <td>
						     <div class="invoice-rt">
						    <a href="#">
						     <div class="invoice-in">
							   <img src="images/mail-user.png" alt=""/>
							 </div>
						   Sent invoice
						   </a>
						   </div>
						  </td>
						</tr>
						<tr>
						  <td>
						    <div class="invoice-lf">
								 <a href="/"><img alt="" src="images/notification03.jpg"></a>
								 </div>
						  </td>
						  <td>
						    <div class="invoice-middle">
								  <a href="/"><h2>Smart</h2></a>
								  <ul>
								   <li>Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li>Sales<span>124</span></li>
								  </ul>
								</div>
						  </td>
						  <td>
						     <div class="invoice-rt">
						    <a href="#">
						     <div class="invoice-in">
							   <img src="images/mail-user.png" alt=""/>
							 </div>
						   Sent invoice
						   </a>
						   </div>
						  </td>
						</tr>
						<tr>
						  <td>
						    <div class="invoice-lf">
								 <a href="/"><img alt="" src="images/notification01.jpg"></a>
								 </div>
						  </td>
						  <td>
						    <div class="invoice-middle">
								  <a href="/"><h2>KTM Bikes in Germany</h2></a>
								  <ul>
								   <li>Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li>Sales<span>124</span></li>
								  </ul>
								</div>
						  </td>
						  <td>
						   <div class="invoice-rt">
						    <a href="#">
						     <div class="invoice-in">
							   <img src="images/mail-user.png" alt=""/>
							 </div>
						   Sent invoice
						   </a>
						   </div>
						  </td>
						</tr>
						<tr>
						  <td>
						    <div class="invoice-lf">
								 <a href="/"><img alt="" src="images/notification02.jpg"></a>
								 </div>
						  </td>
						  <td>
						    <div class="invoice-middle">
								  <a href="/"><h2>Giant</h2></a>
								  <ul>
								   <li>Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li>Sales<span>124</span></li>
								  </ul>
								</div>
						  </td>
						  <td>
						     <div class="invoice-rt">
						    <a href="#">
						     <div class="invoice-in">
							   <img src="images/mail-user.png" alt=""/>
							 </div>
						   Sent invoice
						   </a>
						   </div>
						  </td>
						</tr>
						<tr>
						  <td>
						    <div class="invoice-lf">
								 <a href="/"><img alt="" src="images/notification04.jpg"></a>
								 </div>
						  </td>
						  <td>
						    <div class="invoice-middle">
								  <a href="/"><h2>Yamaha LTD</h2></a>
								  <ul>
								   <li>Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li>Sales<span>124</span></li>
								  </ul>
								</div>
						  </td>
						  <td>
						     <div class="invoice-rt">
						    <a href="#">
						     <div class="invoice-in">
							   <img src="images/mail-user.png" alt=""/>
							 </div>
						   Sent invoice
						   </a>
						   </div>
						  </td>
						</tr>
						<tr>
						  <td>
						    <div class="invoice-lf">
								 <a href="/"><img alt="" src="images/notification05.jpg"></a>
								 </div>
						  </td>
						  <td>
						    <div class="invoice-middle">
								  <a href="/"><h2>Logitech</h2></a>
								  <ul>
								   <li>Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li>Sales<span>124</span></li>
								  </ul>
								</div>
						  </td>
						  <td>
						     <div class="invoice-rt">
						    <a href="#">
						     <div class="invoice-in">
							   <img src="images/mail-user.png" alt=""/>
							 </div>
						   Sent invoice
						   </a>
						   </div>
						  </td>
						</tr>
						<tr>
						  <td>
						    <div class="invoice-lf">
								 <a href="/"><img alt="" src="images/notification03.jpg"></a>
								 </div>
						  </td>
						  <td>
						    <div class="invoice-middle">
								  <a href="/"><h2>Smart</h2></a>
								  <ul>
								   <li>Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li>Sales<span>124</span></li>
								  </ul>
								</div>
						  </td>
						  <td>
						     <div class="invoice-rt">
						    <a href="#">
						     <div class="invoice-in">
							   <img src="images/mail-user.png" alt=""/>
							 </div>
						   Sent invoice
						   </a>
						   </div>
						  </td>
						</tr>
						<tr>
						  <td>
						    <div class="invoice-lf">
								 <a href="/"><img alt="" src="images/notification01.jpg"></a>
								 </div>
						  </td>
						  <td>
						    <div class="invoice-middle">
								  <a href="/"><h2>KTM Bikes in Germany</h2></a>
								  <ul>
								   <li>Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li>Sales<span>124</span></li>
								  </ul>
								</div>
						  </td>
						  <td>
						   <div class="invoice-rt">
						    <a href="#">
						     <div class="invoice-in">
							   <img src="images/mail-user.png" alt=""/>
							 </div>
						   Sent invoice
						   </a>
						   </div>
						  </td>
						</tr>
						<tr>
						  <td>
						    <div class="invoice-lf">
								 <a href="/"><img alt="" src="images/notification02.jpg"></a>
								 </div>
						  </td>
						  <td>
						    <div class="invoice-middle">
								  <a href="/"><h2>Giant</h2></a>
								  <ul>
								   <li>Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li>Sales<span>124</span></li>
								  </ul>
								</div>
						  </td>
						  <td>
						     <div class="invoice-rt">
						    <a href="#">
						     <div class="invoice-in">
							   <img src="images/mail-user.png" alt=""/>
							 </div>
						   Sent invoice
						   </a>
						   </div>
						  </td>
						</tr>
						<tr>
						  <td>
						    <div class="invoice-lf">
								 <a href="/"><img alt="" src="images/notification04.jpg"></a>
								 </div>
						  </td>
						  <td>
						    <div class="invoice-middle">
								  <a href="/"><h2>Yamaha LTD</h2></a>
								  <ul>
								   <li>Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li>Sales<span>124</span></li>
								  </ul>
								</div>
						  </td>
						  <td>
						     <div class="invoice-rt">
						    <a href="#">
						     <div class="invoice-in">
							   <img src="images/mail-user.png" alt=""/>
							 </div>
						   Sent invoice
						   </a>
						   </div>
						  </td>
						</tr>
						<tr>
						  <td>
						    <div class="invoice-lf">
								 <a href="/"><img alt="" src="images/notification05.jpg"></a>
								 </div>
						  </td>
						  <td>
						    <div class="invoice-middle">
								  <a href="/"><h2>Logitech</h2></a>
								  <ul>
								   <li>Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li>Sales<span>124</span></li>
								  </ul>
								</div>
						  </td>
						  <td>
						     <div class="invoice-rt">
						    <a href="#">
						     <div class="invoice-in">
							   <img src="images/mail-user.png" alt=""/>
							 </div>
						   Sent invoice
						   </a>
						   </div>
						  </td>
						</tr>
						<tr>
						  <td>
						    <div class="invoice-lf">
								 <a href="/"><img alt="" src="images/notification03.jpg"></a>
								 </div>
						  </td>
						  <td>
						    <div class="invoice-middle">
								  <a href="/"><h2>Smart</h2></a>
								  <ul>
								   <li>Ranking<span>153</span></li>
								   <li>State Ranking<span>105</span></li>
								   <li>Sales<span>124</span></li>
								  </ul>
								</div>
						  </td>
						  <td>
						     <div class="invoice-rt">
						    <a href="#">
						     <div class="invoice-in">
							   <img src="images/mail-user.png" alt=""/>
							 </div>
						   Sent invoice
						   </a>
						   </div>
						  </td>
						</tr>
					  </tbody>
					</table>
					</div>
				  </div>
	              </div>
	       </div>	    
		   <!--dashboard tab2 end -->
		    <div class="knowledge-base">
			  <h2>Knowledge base<span><a href="#">See all<i class="fa fa-chevron-right"></i></a></span></h2>
			  <ul>
			    <li><a href="#">How does Oraisen work ?</a></li>
	        <li><a href="#">How can I set a commission for a product?</a></li>
	        <li><a href="#">How can I start selling products online ?</a> </li>
	        <li><a href="#">What is this website about?</a></li>
	        <li><a href="#">How can I become a marketer?</a></li>
	        <li><a href="#">What is the difference between a marketer and a provider?</a></li>
			  </ul>
	      <div class="clearfix"></div>
			  
			</div>
	    <!--knowledge base end-->
	    <div class="content-bottom">
	      <h2>Find the right product to sell in our market place</h2>
	      <div class="row">
	        <div class="col-sm-6 prod-lf">
	           <a href="#"><img src="images/local-icon.png" alt=""/></a>
	           <div class="product-text">
	             <a href="#"><h2>Local</h2></a>
	             <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis.</p>
	           </div>
	           <div class="clearfix"></div>
	        </div>
	        <div class="col-sm-6 prod-lf">
	          <a href="#"><img src="images/global-icon.png" alt=""/></a>
	           <div class="product-text">
	             <a href="#"><h2>Global</h2></a>
	             <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis.</p>
	           </div>
	           <div class="clearfix"></div>
	        </div>
	      </div>
	      <div class="row">
	        <div class="col-sm-6 prod-lf">
	           <a href="#"><img src="images/membership-icon.png" alt=""/></a>
	           <div class="product-text">
	             <a href="#"><h2>Recurring<span>Membership</span></h2></a>
	             <p>Anything that charges more than once and will pay per charge</p>
	           </div>
	           <div class="clearfix"></div>
	        </div>
	        <div class="col-sm-6 prod-lf">
	           <a href="#"><img src="images/online-icon.png" alt=""/></a>
	           <div class="product-text">
	             <a href="#"><h2>Online</h2></a>
	             <p>Anything you can advertise from anywhere- ebooks, software, etc.</p>
	           </div>
	           <div class="clearfix"></div>
	        </div>
	      </div>
	    </div>
	    <div class="content-bottom content-bottom1">
	      <div class="row">
	        <div class="col-sm-6">
	          <div class="recruit-text">
	          <img alt="" src="images/recruit-user.png">
	          <h2>Recruit Users</h2>
	          <p>Earn up to 30% of every sale for that<br/> business for a year!</p>          
	          </div>
	          <div class="recruit-btn">
	           <a href="#">
	           <div class="recruit-btn-icon">
	             <i class="fa fa-plus-circle"></i>
	           </div>
	            RECRUIT USERS
	            </a>
	          </div>
	        </div>
	        <div class="col-sm-6">
	          <div class="recruit-text">
	          <img alt="" src="images/recruit-business.png">
	          <h2>Recruit Businesses</h2>
	          <p>Earn up to 5% of every sale <br/>they make for life</p>
	          </div>
	          <div class="recruit-btn">
	           <a href="#">
	           <div class="recruit-btn-icon">
	             <i class="fa fa-plus-circle"></i>
	           </div>
	            RECRUIT BUSINESSES
	            </a>
	          </div>
	        </div>
	      </div>
	    </div>
		   </div>
		   <!--dashborad content end-->
	 </div>
	 </div>
	 <!--dashboard inner-->
	  </div>
	  <!--dashboard cont-->
	  </div>
	  <!--container end-->
	 </section>
@stop

@section('customFooterScript')
	<!--table paging jquery-->
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	{!! Html::script( 'js/paging.js' ) !!}
@stop

@section('footerJavascript')
	<script type="text/javascript">
        $(document).ready(function() {
            $('#tableData').paging({limit:5});
            
        });
    </script>
	<script type="text/javascript">
        $(document).ready(function() {
            $('#tableData1').paging({limit:5});
            
        });
    </script>
@stop