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
	<!--custom-select-->
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script type="text/javascript">
	    $(document).ready(function(){
	        $(".custom-select4").each(function(){
	            $(this).wrap("<span class='select-wrapper4'></span>");
	            $(this).after("<span class='holder'></span>");
	        });
	        $(".custom-select4").change(function(){
	            var selectedOption = $(this).find(":selected").text();
	            $(this).next(".holder").text(selectedOption);
	        }).trigger('change');
	    })
	</script>
	<!--tabs-->
	<script>
	$('#myTab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})
	</script>
	<!--tabs end-->
@stop

@section('pageContainer')	
	<section class="market-top">
        <div class="container1">
           <div class="top-h">
              <div class="marketplace">
                            <h2>Statistics</h2>
                        </div> 
              </div>   	
    	</div>
	</section>
	<section class="content3">
	  <div class="container1">
	     <div class="rank row">
		   <div class="col-sm-12 statistic-tab">
		   <h2>Overview</h2>
		   <div class="overview">
		     <div class="col-sm-3 col-xs-12 statistic">
			   <img src="images/sales.png" alt=""/>
			   <h2>260</h2>
			   <h3>total sales</h3>
			 </div>
			 <div class="col-sm-3 col-xs-12 statistic visit">
			 <img src="images/visitor.png" alt=""/>
			   <h2>960</h2>
			   <h3>TOTAL VISITORS</h3>
			 </div>
			 <div class="col-sm-3 col-xs-12 statistic click">
			   <img src="images/click.png" alt=""/>
			   <h2>487</h2>
			   <h3>TOTAL CLICKS</h3>
			 </div>
			 <div class="col-sm-3 col-xs-12 statistic earn">
			   <img src="images/earning.png" alt=""/>
			   <h2>$4.854</h2>
			   <h3>TOTAL EARNINGS</h3>
			 </div>
			 <div class="clearfix"></div>
		   </div>
		   <div class="tab-row">
		     <div role="tabpanel">
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs statistic-list" role="tablist">
	    <li role="presentation" class="active"><a href="#sales" aria-controls="sales" role="tab" data-toggle="tab"><span><img src="images/sales.png" alt=""/></span>sales</a></li>
	    <li role="presentation"><a href="#visitor" aria-controls="visitor" role="tab" data-toggle="tab"><span><img src="images/visitor.png" alt=""/></span>visitors</a></li>
		<li role="presentation"><a href="#clicks" aria-controls="clicks" role="tab" data-toggle="tab"><span><img src="images/click.png" alt=""/></span>clicks</a></li>
		<li role="presentation"><a href="#earning" aria-controls="earning" role="tab" data-toggle="tab"><span><img src="images/earning.png" alt=""/></span>earnings</a></li>	
		</ul>	
	  <!-- Tab panes -->
	  <div class="tab-content statistic-cont">
	    <div role="tabpanel" class="tab-pane active" id="sales">
		 <div class="row">
		  <div class="col-sm-12 graph">
		    <img src="images/graph.png" alt=""/>
			</div>
		  </div>
		</div><!--tab-panel1-->
	    <div role="tabpanel" class="tab-pane" id="visitor">
	        <div class="row">
		  <div class="col-sm-12 graph">
		    <img src="images/graph1.png" alt=""/>
			</div>
		  </div>
		</div><!--tab panel2-->
		<div role="tabpanel" class="tab-pane" id="clicks">
		    <div class="row">
		  <div class="col-sm-12 graph">
		    <img src="images/graph.png" alt=""/>
			</div>
		  </div>
		</div><!--tab panel3-->
		<div role="tabpanel" class="tab-pane" id="earning">
	        <div class="row">
		  <div class="col-sm-12 graph">
		    <img src="images/graph1.png" alt=""/>
			</div>
		  </div>
		  </div><!--tab panel4-->
		</div><!--tab-content-->
	    </div><!--tab-panel-->
	    <div class="select-statistic">
	      <select name="" class="custom-select4">
	        <option>Last 30 days</option>
	        <option>dummy text1</option>
	        <option>dummy text2</option>
	        <option>dummy text3</option>
	      </select>
	    </div>
	    </div><!--tab-row-->
	           <div class="products">
	              <h2>My Products</h2>
	                 <div class="select-statistic1">
	                  <select name="" class="custom-select4">
	                    <option>Last 30 days</option>
	                    <option>dummy text1</option>
	                    <option>dummy text2</option>
	                    <option>dummy text3</option>
	                  </select>
	                 </div>
					 
					 <div class="myprod-list">
					  <div class="myprod-list1">
					    <div class="col-xs-5 product-h">
						  <h2>Product</h2>
						</div>
						<div class="col-xs-7 product-i">
						  <div class="col-xs-3 sale-icons">
						    <a href="#"><img src="images/sales.png" alt=""/></a>
						  </div>
						  <div class="col-xs-3 sale-icons">
						     <a href="#"><img src="images/visitor.png" alt=""/></a>
						  </div>
						  <div class="col-xs-3 sale-icons">
						    <a href="#"><img src="images/click.png" alt=""/></a>
						  </div>
						  <div class="col-xs-3 sale-icons">
						    <a href="#"><img src="images/earning.png" alt=""/></a>
						  </div>
						  <div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					  
					  </div>
					  <div class="myprod-list2">
					     <div class="col-xs-5 product-h">
						   <a href="#"><img src="images/tier1.jpg" alt=""/></a>
						   <a href="#"><p>Hankook Optimo H724 All-Season</p></a>
						 </div>
						 <div class="col-xs-7 product-i">
						  <div class="col-xs-3 sale-icons">
						    <h3>152</h3>
						  </div>
						  <div class="col-xs-3 sale-icons">
						     <h3>356</h3>
						  </div>
						  <div class="col-xs-3 sale-icons">
						    <h3>376</h3>
						  </div>
						  <div class="col-xs-3 sale-icons">
						    <h3>$965</h3>
						  </div>
						  <div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					  </div>
					   <div class="myprod-list2">
					     <div class="col-xs-5 product-h">
						   <a href="#"><img src="images/tier2.jpg" alt=""/></a>
						   <a href="#"><p>Falken FK451 245/35R17</p></a>
						 </div>
						 <div class="col-xs-7 product-i">
						  <div class="col-xs-3 sale-icons">
						    <h3>54</h3>
						  </div>
						  <div class="col-xs-3 sale-icons">
						     <h3>287</h3>
						  </div>
						  <div class="col-xs-3 sale-icons">
						    <h3>256</h3>
						  </div>
						  <div class="col-xs-3 sale-icons">
						    <h3>$535</h3>
						  </div>
						  <div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					  </div>
					  <div class="myprod-list2">
					     <div class="col-xs-5 product-h">
						   <a href="#"><img src="images/tier3.jpg" alt=""/></a>
						   <a href="#"><p class="tiertxt">Hankook Optimo H724 All-Season<br/> Tire - 235/75R15 108S</p></a>
						 </div>
						 <div class="col-xs-7 product-i">
						  <div class="col-xs-3 sale-icons">
						    <h3>38</h3>
						  </div>
						  <div class="col-xs-3 sale-icons">
						     <h3>301</h3>
						  </div>
						  <div class="col-xs-3 sale-icons">
						    <h3>310</h3>
						  </div>
						  <div class="col-xs-3 sale-icons">
						    <h3>$348</h3>
						  </div>
						  <div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					  </div>
					  <div class="myprod-list2">
					     <div class="col-xs-5 product-h">
						   <a href="#"><img src="images/tier4.jpg" alt=""/></a>
						   <a href="#"><p>Goodyear Eagle LS Radial Tire</p></a>
						 </div>
						 <div class="col-xs-7 product-i">
						  <div class="col-xs-3 sale-icons">
						    <h3>64</h3>
						  </div>
						  <div class="col-xs-3 sale-icons">
						     <h3>176</h3>
						  </div>
						  <div class="col-xs-3 sale-icons">
						    <h3>183</h3>
						  </div>
						  <div class="col-xs-3 sale-icons">
						    <h3>$109</h3>
						  </div>
						  <div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					  </div>
					   <div class="myprod-list2">
					     <div class="col-xs-5 product-h">
						   <a href="#"><img src="images/tier5.jpg" alt=""/></a>
						   <a href="#"><p class="tiertxt">Goodyear Eagle LS Radial<br> Tire - 205/55R16 89T</p></a>
						 </div>
						 <div class="col-xs-7 product-i">
						  <div class="col-xs-3 sale-icons">
						    <h3>64</h3>
						  </div>
						  <div class="col-xs-3 sale-icons">
						     <h3>176</h3>
						  </div>
						  <div class="col-xs-3 sale-icons">
						    <h3>183</h3>
						  </div>
						  <div class="col-xs-3 sale-icons">
						    <h3>$65</h3>
						  </div>
						  <div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					  </div>
					 </div>
	           </div><!--products-->
			   <div class="ranking-h">
			    <div class="row">
				 <div class="col-sm-4 col-xs-12 rank-h">
				   <h2>Rankings</h2>
				   </div>
				 <div class="col-sm-8 col-xs-12 rank-tab1">
				   <div class="col-sm-4 col-xs-12 rank-select">
				       <select name="" class="custom-select4">
	                     <option>Overall Ranking</option>
	                     <option>dummy text1</option>
	                     <option>dummy text2</option>
	                     <option>dummy text3</option>
	                   </select>
				   </div>
				   <div class="col-sm-4 col-xs-12 gainbox">
				    <a class="gain" href="#"><i class="glyphicon glyphicon-arrow-up" aria-hidden="true"></i>Gained</a>
				   </div>
				   <div class="col-sm-4 col-xs-12 lostbox">
				     <a class="lost" href="#"><i class="glyphicon glyphicon-arrow-down" aria-hidden="true"></i>Lost</a>
				   </div>
				   <div class="clearfix"></div>
				 </div>
				</div>
			   </div><!--ranking-->
			   <div class="overview1">
		     <div class="statistic1">
			   <img src="images/rank1.png" alt=""/>
			   <h2>125</h2>
			   <h3>Virtual goods </h3>
			 </div>
			 <div class="statistic1">
			 <img src="images/rank2.png" alt=""/>
			   <h2>45</h2>
			   <h3>Psyhical goods</h3>
			 </div>
			 <div class="statistic1">
			   <img src="images/rank3.png" alt=""/>
			   <h2>512</h2>
			   <h3>REal estate</h3>
			 </div>
			 <div class="statistic1">
			   <img src="images/rank4.png" alt=""/>
			   <h2>55</h2>
			   <h3>Automotive</h3>
			 </div>
			  <div class="statistic1">
			   <img src="images/rank5.png" alt=""/>
			   <h2>73</h2>
			   <h3>service providers</h3>
			 </div>
			 <div class="clearfix"></div>
		   </div>
		   </div><!--statistic-tab-->	   
		 </div><!--ranking-->
	  </div><!--container-->  
	</section>
@stop