@extends('layouts.home_default')

@section('customStyles')
	<!--tabs-->
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/simptip.min.css') }}" media="screen,projection" />
    {!! Html::style( 'css/tabs/tabs.css' ) !!}
    {!! Html::style( 'css/tabs/tabstyles.css' ) !!}
    <!--tabs end-->
@stop

@section('styles')
<style type="text/css">
    button.post-button{
        font-size: 20px;
        padding: 5px 10px;
        background-color: white;
        width: 100%;
        display: block;
        font-weight: bold;
        margin-bottom: 20px;
        text-transform: uppercase;
    }
    .post-textarea{
        resize:none;
        width: 100%;
        height: 70px;
    }
    .modal-body .row .post-input{
        margin-top: 10px;
        color: #333 !important;
        border: 1px solid #777;
        width: 100%;
    }
    .send-btn{
        margin: 10px auto;
        width: 100px;
        background-color: #333;
        color: white;
        font-size: 20px;
        display: block;
    }
    #postProduct .btn-primary{
        margin-top: 20px;
        margin-right: 30px; 
        float: right;
    }
    .item .post-img{
        width: 100%;
        height: 120px;
    }
    #products h3{
        text-align: center;
    }
    a{
        cursor:pointer;
    }
</style>
@stop

@section('headerJavascript')
	<script type="text/javascript" >
        $(document).ready(function ()
        {
            $(".menu-drop").click(function ()
            {
                var X = $(this).attr('id');
                if (X == 1)
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
            $(".menu-dropdown").mouseup(function ()
            {
                return false
            });
            $(".menu-drop").mouseup(function ()
            {
                return false
            });
            //Textarea without editing.
            $(document).mouseup(function ()
            {
                $(".menu-dropdown").hide();
                $(".menu-drop").attr('id', '');
            });
        });
    </script>
    <script type="text/javascript" >
        $(document).ready(function ()
        {
            $(".profile").click(function ()
            {
                var X = $(this).attr('id');

                if (X == 1)
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
            $(".dropdown1").mouseup(function ()
            {
                return false
            });
            $(".profile").mouseup(function ()
            {
                return false
            });
            //Textarea without editing.
            $(document).mouseup(function ()
            {
                $(".dropdown1").hide();
                $(".profile").attr('id', '');
            });
        });
    </script>
    <!--toogle end-->
    <!--custom-select-->
   <script src="https://code.jquery.com/jquery-1.11.0.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".custom-select").each(function () {
                $(this).wrap("<span class='select-wrapper'></span>");
                $(this).after("<span class='holder'></span>");
            });
            $(".custom-select").change(function () {
                var selectedOption = $(this).find(":selected").text();
                $(this).next(".holder").text(selectedOption);
            }).trigger('change');
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".custom-select1").each(function () {
                $(this).wrap("<span class='select-wrapper1'></span>");
                $(this).after("<span class='holder'></span>");
            });
            $(".custom-select1").change(function () {
                var selectedOption = $(this).find(":selected").text();
                $(this).next(".holder").text(selectedOption);
            }).trigger('change');
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".custom-select2").each(function () {
                $(this).wrap("<span class='select-wrapper2'></span>");
                $(this).after("<span class='holder'></span>");
            });
            $(".custom-select2").change(function () {
                var selectedOption = $(this).find(":selected").text();
                $(this).next(".holder").text(selectedOption);
            }).trigger('change');
        })
    </script>
    <!--Mix it up-->
    <script>
        $(document).ready(function () {
            $(".series-selector-items > li").click(function () {
                $(this).toggleClass('selected');
                filterItems();
            });
        });

        function filterItems() {
            var classSelectors = $(".selected").map(function () {
                var cls = this.id.split('-');
                return '.' + cls.splice(2).join('-');
            }).toArray();

            //if no filter, show all
            if (!classSelectors.length) {
                $('#items  .product').show('slow');
            }

            $('#items  .product').filter(classSelectors.join('')).show('slow');

            $('#items  .product').not(function () {
                var self = this;
                var showThis = true;
                $.each(classSelectors, function (i, value) {
                    if (!$(self).is(value)) {
                        showThis = false;
                    }
                });
                return showThis;
            }).hide('slow');
        }

    </script>
    <!--Mix it up-->
	<!--modal -->
	<script type="text/javascript">$('#myModal').on('shown.bs.modal', function () {
	$('#myInput').focus()
	})
	</script>
@stop

@section('pageContainer')	
	<!-- Modal -->
    <div class="products-modelbox">
        <div class="modal fade" id="postModal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="closediv" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                    <div class="modal-body">
                    
                    {!! Form::open(array('url' => 'post/product', 'method' => 'post', 'id' => 'postProduct', 'enctype' => 'multipart/form-data', 'files' => true)) !!}

                        <div class="row">
                            <div class="col-sm-4">
                                <h4>Product Image</h4>
                            </div>
                            <div class="col-sm-8">
                                {!! Form::file('image',array('id'=>'upload_file')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <h4>Product Name</h4>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="post-input" name="product_name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <h4>Description</h4>
                            </div>
                            <div class="col-sm-8">
                                <textarea class="post-textarea" name="product_description"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <h4>Price</h4>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="post-input" name="product_price">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <h4>Commission</h4>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="post-input" name="product_comission">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="post-input" name="thank_url" placeholder="thank you page url">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="post-input" name="product_url" placeholder="product page url">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <h4>Product Type</h4>
                            </div>
                            <div class="col-sm-8">
                                <select name="product_category" id="option" title="Please select one!" class="post-input" required>
                                    <option value="">Select one</option>
                                    <option value="Automotive">Automotive</option>
                                    <option value="Virtual Goods">Virtual Goods</option>
                                    <option value="Real Estate">Real Estate</option>
                                    <option value="Service Providers">Service Providers</option>
                                    <option value="Physical Goods">Physical Goods</option>
                                    <option value="Category">Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <h4>Zipcode</h4>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="post-input" name="product_zipcode">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                {!!  Form::submit('POST', array('class'=>'btn btn-primary'))  !!}
                                 
                            </div>
                        </div>
                        
                     {!! Form::close() !!}
                    </div>          
                </div>
            </div>
        </div>
    </div>
    <div class="products-modelbox">
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		    <button type="button" class="closediv" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
		          <div class="modal-body">
		       <div class="row">
		         <div class="col-sm-6">
		           <div class="tire">
		             <img src="" alt=""/>
		           </div>
		         </div>
		         <div class="col-sm-6">
		           <div class="tire-text">
		             <h1 class="pop-description"></h1>
		             <p><span><img alt="" src="images/virtual-icon.png"></span><span class="product-category"></span></p>
		             <ul>
		               <li><span><img src="images/payment.png" alt=""/></span> Recurring </li>
		               <li><span><img src="images/home-icon.png" alt=""/></span> Local</li>
		               <li><span><img src="images/earth.png" alt=""/></span> Global</li>
		             </ul>
		             <h2><span class="pop-commission"></span><span>Commission price</span></h2>
		           </div>
		         </div>
		       </div>
		       <div class="row">
		         <div class="col-sm-8">
		           <div class="referral-link">
		             <h3>Referral link</h3>
		             <div class="referral-box">
		               <p class="referral-id"></p>
		               <button>Copy</button>
		               <div class="clearfix"></div>
		             </div>
		           </div>
		         </div>
		         <div class="col-sm-4">
		           <div class="referral-link">
		           <h3>&nbsp;</h3>
		             <div class="added-user-rt">
		              <a href="#">
		               <div class="added-user-rt-in">
		               <i class="fa fa-plus-circle"></i>
		             </div>Add product </a>
		             </div>
		           </div>
		         </div>
		       </div>
		      </div>
		   
		    </div>
		  </div>
		</div>
	</div>
    <div class="clearfix"></div>
                </div><!--row-->
            </div><!--container-->
        </div>

        <div class="market-top">
            <div class="container1">
                        <div class="marketplace">
                            <h2>Marketplace</h2>
                        </div>
            </div>
        </div>
        <div class="content2">
            <div class="container1">
                <div class="row">
                    <div class="col-sm-3 market-left">
                        @if($permission == true)
                        <div class="post-product">
                            <button class="post-button" data-toggle="modal" data-target="#postModal">post</button>
                        </div>
                        @endif
                       <div class="filter-box">
                            <a id="filters">Filters
							<i class="fa fa-angle-up iconup desktop"></i>
							<i class="fa fa-angle-down icondown mobile"></i>
							</a>
                            </div>
                        <div class="filter-fold">
                            <div class="market-left1">
                                <h1>Category</h1>
                                <div class="panel-group" id="accordion">
                                   <div class="panel panel-default">
                                       <div class="panel-heading">
                                           <h4 class="panel-title">
                                            <a class="accordion-toggle accordion-opened collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            Automotive
                                            </a>
                                            </h4>
                                        </div>
                                       <div id="collapseOne" class="panel-collapse collapse">
                                           <div class="panel-body">
                                                <ul class="sub-category">
                                                    <li><a class="active" onclick="filterByCategory('Automotive');">Tires &amp; Wheels</a></li>
                                                    <li><a onclick="filterByCategory('Automotive');">Car, Light Truck & SUV</a></li>
                                                    <li><a onclick="filterByCategory('Automotive');">Tire Repair Tools</a></li>
                                                    <li><a onclick="filterByCategory('Automotive');">Tire Gauges</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                 </div>  
 
                               <div class="panel panel-default">
                                <div class="panel-heading">
                                   <h4 class="panel-title">
                                     <a class="accordion-toggle accordion-opened collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                      Virtual Goods
                                       </a>
                                   </h4>
                                  </div>
                                  <div id="collapseTwo" class="panel-collapse collapse">
                                      <div class="panel-body">
                                                <ul class="sub-category">
                                                    <li><a class="active" onclick="filterByCategory('Virtual Goods');">Tires &amp; Wheels</a></li>
                                                    <li><a onclick="filterByCategory('Virtual Goods');">Car, Light Truck & SUV</a></li>
                                                    <li><a onclick="filterByCategory('Virtual Goods');">Tire Repair Tools</a></li>
                                                    <li><a onclick="filterByCategory('Virtual Goods');">Tire Gauges</a></li>
                                                </ul>
                                            </div>
                                  </div>
                                 </div>
                                <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle accordion-opened collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                     Real Estate
                                    </a>
                                    </h4>
                                 </div>
                                 <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                                <ul class="sub-category">
                                                    <li><a class="active" onclick="filterByCategory('Real Estate');">Tires &amp; Wheels</a></li>
                                                    <li><a onclick="filterByCategory('Real Estate');">Car, Light Truck & SUV</a></li>
                                                    <li><a onclick="filterByCategory('Real Estate');">Tire Repair Tools</a></li>
                                                    <li><a onclick="filterByCategory('Real Estate');">Tire Gauges</a></li>
                                                </ul>
                                            </div>
                                      </div>
                                     </div>
                                 <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h4 class="panel-title">
                                              <a class="accordion-toggle accordion-opened collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                               Service Providers
                                               </a>
                                             </h4>
                                           </div>
                                    <div id="collapseFour" class="panel-collapse collapse">
                                           <div class="panel-body">
                                                <ul class="sub-category">
                                                    <li><a class="active" onclick="filterByCategory('Service Providers');">Tires &amp; Wheels</a></li>
                                                    <li><a onclick="filterByCategory('Service Providers');">Car, Light Truck & SUV</a></li>
                                                    <li><a onclick="filterByCategory('Service Providers');">Tire Repair Tools</a></li>
                                                    <li><a onclick="filterByCategory('Service Providers');">Tire Gauges</a></li>
                                                </ul>
                                            </div>
                                     </div>
                                     </div>
                                     <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h4 class="panel-title">
                                            <a class="accordion-toggle accordion-opened collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                             Physical Goods
                                            </a>
                                             </h4>
                                          </div>
                                       <div id="collapseFive" class="panel-collapse collapse">
                                          <div class="panel-body">
                                                <ul class="sub-category">
                                                    <li><a class="active" onclick="filterByCategory('Physical Goods');">Tires &amp; Wheels</a></li>
                                                    <li><a onclick="filterByCategory('Physical Goods');">Car, Light Truck & SUV</a></li>
                                                    <li><a onclick="filterByCategory('Physical Goods');">Tire Repair Tools</a></li>
                                                    <li><a onclick="filterByCategory('Physical Goods');">Tire Gauges</a></li>
                                                </ul>
                                            </div>
                                          </div>
                                          </div>
                                         <div class="panel panel-default">
                                            <div class="panel-heading">
                                               <h4 class="panel-title">
                                                  <a class="accordion-toggle accordion-opened collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                                                  Category
                                                   </a>
                                                 </h4>
                                             </div>
                                           <div id="collapseSix" class="panel-collapse collapse">
                                               <div class="panel-body">
                                                <ul class="sub-category">
                                                    <li><a class="active" onclick="filterByCategory('Category');">Tires &amp; Wheels</a></li>
                                                    <li><a onclick="filterByCategory('Category');">Car, Light Truck & SUV</a></li>
                                                    <li><a onclick="filterByCategory('Category');">Tire Repair Tools</a></li>
                                                    <li><a onclick="filterByCategory('Category');">Tire Gauges</a></li>
                                                </ul>
                                            </div>
                                            </div>
                                           </div>
                                      </div>
                                <!--accordion end-->
                                </div>
                            <div class="market-left2">
                                <h2>Commission range</h2>
                                <div class="demo">
                                    <p>
                                         <input type="text" class="amount" class="sliderValue" data-index="0" value="25" />
                                         <span>-</span>
                                          <input type="text" class="amount1" class="sliderValue" data-index="1" value="200" />
                                    </p>

                                    <div id="slider-range"></div>
                                </div>

                            </div>

                            <div class="market-left2">
                                <h2>distance</h2>
                                <div class="demo">
                                    <p>
                                        <input type="text" class="amount2" class="sliderValue" data-index="0" value="300" />
                                        <span>-</span>
                                         <input type="text" class="amount3" class="sliderValue" data-index="1" value="3000" />
                                    </p>
                                    <div id="slider-range1"></div>
                                </div>
                            </div>
                            <div class="market-left2 zipcode">
                                <h2>Zip Code</h2>
                                <input type="text" onfocus="if (this.value == 'MD-2060')
                                this.value = '';" onblur="if (this.value == '')
                                  this.value = 'MD-2060';" value="MD-2060" class="searchzip">
                                <input type="submit" value="APPLY"/>
                            </div>                            
                            </div>
                            <!--filter fold end-->
                        </div>
                    <div class="col-sm-9 market-right">
                        <div class="row1">

                            <div class="col-sm-3 automate">
                                <select name="product" class="custom-select">
                                    <option>All Categories</option>
                                    <option>Automotive</option>
                                    <option>Virtual Goods</option>
                                    <option>Real Estate</option>
                                    <option>Service Providers</option>
                                    <option>Physical Goods</option>
                                    <option>Category</option>
                                    <option>Virtual Goods</option>
                                    <option>Real Estate</option>
                                </select>
                            </div>
                            <div class="col-sm-9 searchright">
                                <div class="search-new">
                                  <input class="search2" type="text" value="Search for products..." onblur="if (this.value == '')
                                  this.value = 'Search for products...';" onfocus="if (this.value == 'Search for products...')  this.value = '';" />
                                  <input type="submit" class="search-btn" />
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row2">
                            <ul class="series-selector-items">
                                <li class="recuring" id="filter-type-R"><span></span> Recurring payments</li>
                                <li class="local" id="filter-type-L"><span></span> Local</li>
                                <li class="global" id="filter-type-G"><span></span> Global</li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row3">
                            <div class="col-sm-4 sort">
                                <h2>Sort by</h2>
                                <select name="sortby" id="sortby" class="custom-select1">
                                    <option value="0">Commission</option>
                                </select>
                            </div>
                            <div class="col-sm-4 sort">
                                <h2>Show</h2>
                                <select name="display" class="custom-select2">
                                    <option>9</option>
                                </select>
                                <h3>per page</h3>
                            </div>
                            <div class="col-sm-4 grid-view">
                                <div class="btn-group">
                                    <a id="list" class="btn btn-primary btn-sm"><h4><span><img src="images/list-view.png" alt=""></span> List view</h4></a>
                                    <a id="grid" class="btn btn-default btn-sm"><h4><span><img src="images/grid-view.png" alt=""></span> Grid view</h4></a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="page">
                            <div class="col-sm-4 result">
                                <p>Showing results <span>9</span> of <span>36</span></p>
                            </div>
                            <div class="col-sm-8 paging">
                                <p>Page</p>
                                <ul class="pagination">

                                    <li>
                                        <a href="#" aria-label="Previous">
                                            <i class="fa fa-chevron-left"></i>
                                        </a>
                                    </li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>

                                    <li class="page-bg">
                                        <a href="#" aria-label="Next">
                                            <i class="fa fa-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>


                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row4" id="items">
                            <div id="products" class="row list-group">
                                    @if(empty($products))
                                        <h3>No Product</h3>
                                    @else
                                        @foreach($products as $index=>$product)
                                            <div class="col-md-4 col-sm-6 col-xs-6 product R L G">
                                                <div class="item">
                                                    <a href="#" data-toggle="modal" data-target="#myModal" class="detail-post" post-id="{!! $product->pdtId !!}"><img src="{!! url($product->pdtImg) !!}" class="post-img" alt="Temp image" /></a>
                                                    <p class="simptip-position-bottom" data-tooltip="Commission price">$ {!! $product->pdtComission !!}</p>
                                                    <a href="#" data-toggle="modal" data-target="#myModal" class="detail-post" post-id="{!! $product->pdtId !!}"><h4 class="post-name">{!! $product->pdtName !!}</h4></a>                                            
                                                    <div class="row-inner">
                                                        <div class="icon-left">
                                                            <h4><span><img src="images/virtual-icon.png" alt=""/></span>{!! $product->pdtCategory !!}
                                                            </h4>
                                                        </div>
                                                        <div class="icon-right">
                                                            <ul>
                                                               <li class="simptip-position-bottom" data-tooltip="Recurring Payments">
                                                               <img src="images/payment.png" alt=""/></li>
                                                               <li><img src="images/marker.png" alt=""/></li>
                                                               <li><img src="images/earth.png" alt=""/></li>                                                       
                                                            </ul>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                @if($index == 0)
                                                    <div class="star">
                                                        <a href="#">Bonus</a>
                                                        <div class="star-hover">
                                                            <h3>+2%<span> Bonus</span></h3>
                                                            <p>On your first sale</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                   
                            </div>
                        </div>
                        <div class="page1">
                            <div class="col-sm-4 result">
                                <p>Showing results <span>9</span> of <span>36</span></p>
                            </div>
                            <div class="col-sm-8 paging">
                                <p>Page</p>
                                <ul class="pagination">
                                    <li>
                                        <a aria-label="Previous" href="#">
                                            <i class="fa fa-chevron-left"></i>
                                        </a>
                                    </li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>

                                    <li class="page-bg">
                                        <a aria-label="Previous" href="#">
                                            <i class="fa fa-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>


                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                    <div class="clearfix"></div>

                    </div><!--row end-->
                </div>
            </div>
@stop

@section('customFooterScript')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
  	<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>


   

    <!--{!! Html::script( 'js/jquery.validate.js' ) !!}-->
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>

    <script scr="http://jqueryvalidation.org/files/dist/additional-methods.min.js" type="text/javascript"></script>

@stop

@section('footerJavascript')
     <!--form validation-->
    <script type="text/javascript">

         
    </script>
		<!--bootstrap--> 
  	<!--grid-list-view-->
    <script type="text/javascript">
        function show_products(products)
        {
            var html = '';

            if(products == '')
                html += '<h3>No Product</h3>';
            else{
                for(var i = 0; i < products.length; i++)
                {
                    html += '<div class="col-md-4 col-sm-6 col-xs-6 product R L G">';
                    html += '<div class="item"><a href="#" data-toggle="modal" data-target="#myModal" class="detail-post" post-id="';
                    html += products[i].pdtId;
                    html += '"><img src="';
                    html += products[i].pdtImg;
                    html += '" class="post-img" alt="Temp image"></a><p class="simptip-position-bottom" data-tooltip="Commission price">$ ';
                    html += products[i].pdtComission;
                    html += '</p><a href="#" data-toggle="modal" data-target="#myModal" class="detail-post" post-id="';
                    html += products[i].pdtId;
                    html += '"><h4 class="post-name">';
                    html += products[i].pdtName;
                    html += '</h4></a><div class="row-inner"><div class="icon-left"><h4><span><img src="images/virtual-icon.png" alt=""></span>';
                    html += products[i].pdtCategory;
                    html += '</h4></div>';
                    html += '<div class="icon-right"><ul><li style="display: none;" class="simptip-position-bottom" data-tooltip="Recurring Payments">';
                    html += '<img src="images/payment.png" alt=""></li><li style="display: none;"><img src="images/marker.png" alt=""></li><li style="display: none;"><img src="images/earth.png" alt=""></li>';
                    html += '</ul></div><div class="clearfix"></div></div><div class="clearfix"></div></div></div>';
                }
            }
            

            $('#products').html(html);
        }

        function filterByCategory(category)
        {
            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
            });
            $.ajax({
                url: '/filter/category',
                type: "POST",
                data: {category:category},
                success: function(data) {
                   
                    var products = data['products'];
                    show_products(products);
                    
                },
                error:function(error)
                {console.log(error);}          
            });
        }
			 $(document).ready(function () {

                

                

                $('.search-new .search-btn').on('click', function(){
                    var product_name = $('.search-new .search2').val();

                    $.ajaxSetup(
                    {
                        headers:
                        {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        }
                    });
                    $.ajax({
                        url: '/search/product',
                        type: "POST",
                        data: {product_name:product_name},
                        success: function(data) {
                           
                            var products = data['products'];
                            show_products(products);
                            
                        },
                        error:function(error)
                        {console.log(error);}          
                    });
                });

                $("#postProduct").validate({
                    rules: {
                        product_name: {
                            required:true
                        },
                        product_description: {
                            required: true,
                        },
                        product_price: {
                            required: true,
                            number: true

                        },
                        product_comission: {
                            required: true,
                            number: true
                        },
                        thank_url: {
                            required: true,
                            url: true
                        },
                        product_url: {
                            required: true,
                            url: true
                        },
                        image:{
                            required: true,
                            },
                        product_category: {
                            required: true
                        },
                        product_zipcode:{
                            required:true,
                            zipcode: true
                        }
                    },
                    messages: {
                            product_name: {required:"Please input the product name."},
                            image:{required:"Please input the image to upload."
                                    },
                            product_description: {required: "Please input the description."},
                            product_price: {required: "Please input the product price.",
                                                number: "please enter number value."},
                            product_comission: {required: "Please input the product comission.",
                                                number: "please enter number value."},
                            thank_url: {required: "Please input the thanks page url.",
                                        url: "Please enter the url such as http://oraisen.com"},
                            product_url: {required: "Please input the product page url.",
                                          url: "Please enter the url such as http://oraisen.com"},
                            product_category: {required: "Please select product type."},
                            product_zipcode: {required: "Please input zipcode.",
                                                zipcode: "Please invalid zipcode."}
                    },
                    submitHandler: function(form) {
                        var formURL = $(form).attr('action') ;                
                        var formData = new FormData($(form)[0]);
                        var filename = $("#upload_file").val();
                        var extension = filename.replace(/^.*\./, '');
                        if(extension == 'jpg' || extension == 'png' || extension == 'gif' || extension == 'jpeg')
                        {
                            $.ajaxSetup(
                            {
                                headers:
                                {
                                    'X-CSRF-Token': $('input[name="_token"]').val()
                                }
                            });
                            $.ajax({
                                url: formURL,
                                type: "POST",
                                data: formData,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(data) {
                                    alert('Posting product successfully.');
                                    $('#postProduct')[0].reset();
                                    var html = '';
                                    var products = data['products'];
                                    show_products(products);
                                    
                                },
                                error:function(error)
                                {console.log(error);}          
                            });
                        }
                        else
                            alert('Please input only file such as jpg, png, gif and jpeg.');
                        
                    }
                });
                
                jQuery.validator.addMethod("zipcode", function(value, element) {
                  return this.optional(element) || /^\d{5}(?:-\d{4})?$/.test(value);
                }, "Please provide a valid zipcode.");



                $('#sortby option').bind('click', function(){
                    var sort_value = $('select[name=sortby]').val();
                    
                    $.ajaxSetup(
                    {
                        headers:
                        {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/sort/product',
                        type: "POST",
                        data: {sort_value:sort_value},
                        success: function(data) {
                            
                            var products = data['products'];
                            show_products(products);
                            
                        },
                        error:function(error)
                        {console.log(error);}          
                    });
                    
                });
                
    			 $('#list').click(function () {
    				$('#products .product').addClass('list-group-item');
    			 });
    			 $('#grid').click(function () {
    			   $('#products .product').removeClass('list-group-item');
    			 });
    			 
                 $(document).ready(function () {
        			 $("#list").click(function () {
        				$("#list").hide();
        			 });
        			 $("#list").click(function () {
        			   $("#grid").show();
        			 });
        			 $("#grid").click(function () {
        			   $("#list").show();
        			 });
        			 $("#grid").click(function () {
        			   $("#grid").hide();
        			 });
    			 });

                 function showProducts(minPrice, maxPrice) {
                    $("#products li").hide().filter(function () {
                        var price = parseInt($(this).data("price"), 10);
                        return price >= minPrice && price <= maxPrice;
                    }).show();
                }

                function filterProductByDistance(maxDistance, minDistance)
                {
                    $.ajaxSetup(
                    {
                        headers:
                        {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/filter/distance',
                        type: "POST",
                        data: {maxDistance:maxDistance, minDistance:minDistance},
                        success: function(data) {
                            var products = data['products'];
                            show_products(products);
                        },
                        error:function(error)
                        {console.log(error);}          
                    });
                }

                $(function () {
                    var options = {
                        range: true,
                        min: 100,
                        max: 5000,
                        values: [300, 3000],
                        slide: function (event, ui) {
                            var min = ui.values[0],
                                    max = ui.values[1];

                            $(".amount2").val( min + "km" );
                            $(".amount3").val(max + "km");


                            showProducts(min, max);
                        },
                        change:function (event, ui){
                            var min = ui.values[0],
                            max = ui.values[1];
                            filterProductByDistance(max, min);
                        }
                    }, min, max;

                    $("#slider-range1").slider(options);

                    min = $("#slider-range1").slider("values", 0);
                    max = $("#slider-range1").slider("values", 1);

                    $(".amount2").val( min + "km" );
                    $(".amount3").val(max + "km");


                    showProducts(min, max);
                });
                
                function showProducts(minPrice, maxPrice) {
                       $("#products li").hide().filter(function () {
                           var price = parseInt($(this).data("price"), 10);
                           return price >= minPrice && price <= maxPrice;
                       }).show();
                   }

                function filterProductByCommission(maxPrice, minPrice)
                {
                    $.ajaxSetup(
                    {
                        headers:
                        {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/filter/commission',
                        type: "POST",
                        data: {maxPrice:maxPrice, minPrice:minPrice},
                        success: function(data) {

                            var products = data['products'];
                            show_products(products);
                            
                        },
                        error:function(error)
                        {console.log(error);}          
                    });
                }

                   $(function () {
                       var options = {
                           range: true,
                           min: 0,
                           max: 500,
                           values: [25, 200],
                           slide: function (event, ui) {
                               var min = ui.values[0],
                                       max = ui.values[1];

                               $(".amount").val("$" + min );
                               $(".amount1").val("$" + max);
                               
                               showProducts(min, max);
                           },
                           change:function (event, ui){
                                var min = ui.values[0],
                                max = ui.values[1];
                                filterProductByCommission(max, min);
                           }
                       }, min, max;

                       $("#slider-range").slider(options);

                       min = $("#slider-range").slider("values", 0);
                       max = $("#slider-range").slider("values", 1);

                       $(".amount").val("$" + min );
                      $(".amount1").val("$" + max);

                       showProducts(min, max);
                   });
		   });
    </script>
    <!--end-->
   
	<!--filter dropdown-->  
	<script type="text/javascript">
	$(document).ready(function () {
    	$('#filters').click(function(){
    		$('.filter-fold').slideToggle('500');
    		$(this).find('i.desktop').toggleClass('fa-angle-down fa-angle-up icondown')
    		$(this).find('i.mobile').toggleClass('fa-angle-up fa-angle-down iconup')
    	});
        $(window).resize(function () {
    		if ($(window).width() < 768) {
    			$(".filter-fold").hide('');
    			$("#filters i").removeClass('fa-angle-up iconup');
    			$("#filters i").addClass('fa-angle-down icondown');
    		}

    		if ($(window).width() > 767) {
    			$(".filter-fold").show('');
    			$("#filters i").removeClass('fa-angle-down icondown');
    			$("#filters i").addClass('fa-angle-up iconup');
    		}

        });
        $(document).on('click', '.detail-post', function(){
            var post_id = $(this).attr("post-id");
            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "select/post",
                type: "POST",
                data: {post_id, post_id},
                success: function(data) {
                    if(data['status'] == 'none')
                        alert('None');
                    else{
                        var product = data['product'];
                        var img_url = '{!! url("';
                        img_url += product.pdtImg;
                        img_url += '") !!}';
                        $('#myModal .tire img').attr("src", img_url);
                        var commission = '$ ';
                        commission += product.pdtComission;
                        $('#myModal .pop-commission').html(commission);
                        $('#myModal .pop-description').html(product.pdtDescription);                        
                        $('#myModal .product-category').html(product.pdtCategory);
                        $('#myModal .referral-id').html(product.pdtCategory);
                        $('#myModal .referral-id').html(product.pdtCUrl);

                    }
                },
                error:function(error)
                {console.log(error);}          
            });
        });
    });
	</script>    
@stop