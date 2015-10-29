@extends('layouts.home_default')

@section('customStyles')
	{!! Html::style( 'css/timeline.css' ) !!}
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
		<!--load more -->
		<script type="text/javascript">
		            $(document).ready(function () {
		                size_li = $("#myList .added-user").size();
		                x = 5;
		                $('#myList .added-user:lt(' + x + ')').show();
		                $('#loadMore').click(function () {
		                    $('#myList .added-user').show();
		                });

		            });
		</script>
@stop

@section('pageContainer')
	<div class="market-top">
	            <div class="container1">
	                        <div class="marketplace">
	                            <h2>Invoices</h2>
	                        </div>
	            </div>
	</div>
	
	<section class="content2">
	   <div class="container1">
	      <div class="row">
		    <div class="col-sm-3">
			     <div class="invoice-box">
	          <div class="latest-invoice">
	            <h2>July 2015</h2>
	            <a href="#"><div class="invoice-text active">
	              <h3>Invoice 144/2015 <span>(27 Jul) </span></h3>
	              <p>Accusantium doloremque</p>
	            </div></a>
	            <a href="#"><div class="invoice-text">
	              <h3>Invoice 131/2015 <span>(24 Jul) </span></h3>
	              <p>Legros, Chmeler and Farrel</p>
	            </div>
	            </a>
	            <a href="#"><div class="invoice-text">
	              <h3>Invoice 57/2015 <span>(19 Jul) </span></h3>
	              <p>Legros, Chmeler and Farrel</p>
	              <div class="due">Overdue</div>
	            </div></a>
	            <a href="#"><div class="invoice-text">
	              <h3>Invoice 144/2015 <span>(18 Jul) </span></h3>
	              <p>Denesik-Reichel</p>
	            </div></a>
	            <a href="#"><div class="invoice-text">
	              <h3>Invoice 57/2015 <span>(11 Jul) </span></h3>
	              <p>accusantium doloremque</p>
	            </div></a>           
	            <div class="latest-invoice">
	            <h2>Oldest</h2>
	            <a href="#"><div class="invoice-text">
	              <h3>Invoice 47/2015 <span>(28 Apr) </span></h3>
	              <p>Denesik-Reichel</p>
	            </div></a>
	            <a href="#"><div class="invoice-text">
	              <h3>Invoice 67/2015 <span>(3 Mar) </span></h3>
	              <p>Sed ut perspiciatis</p>
	            </div></a>
	            <a href="#"><div class="invoice-text">
	              <h3>Invoice 79/2015 <span>(23 Feb) </span></h3>
	              <p>Legros, Chmeler and Farrel</p>
	            </div></a>
	            <a href="#"><div class="invoice-text">
	              <h3>Invoice 301/2015 <span>(23 Feb) </span></h3>
	              <p>Sed ut perspiciatis</p>
	            </div></a>
	            <a href="#"><div class="invoice-text">
	              <h3>Invoice 144/2015 <span>(23 Feb) </span></h3>
	              <p>Legros, Chmeler and Farrel</p>
	            </div></a>
	             <a href="#"><div class="invoice-text">
	              <h3>Invoice 144/2015 <span>(23 Feb) </span></h3>
	              <p>Legros, Chmeler and Farrel</p>
	              <div class="due">Overdue</div>
	            </div></a>
	             <a href="#"><div class="invoice-text">
	              <h3>Invoice 144/2015 <span>(23 Feb) </span></h3>
	              <p>Legros, Chmeler and Farrel</p>
	            </div></a>
	          </div>
	          </div>
	        </div>
			</div>
			<div class="col-sm-9">	
			    <div class="payment-detail">
	           <div class="payment-h">
	          <h2>Oraisen, INC.</h2>
	          <div class="date">Date : 8/03/2014</div>
	          </div>
	          <div class="ship-address">
	            <div class="row">
	              <div class="col-md-4 address">
	                <h3><span>From</span>Admin, Inc.</h3>
	                <p>95 Folsom Ave, Suite 600</p>
	                <p>San Francisco, CA 94107</p>
	                <p><span>Phone:</span> (804) 123-5432</p>
	                <p><span>Email:</span> info@almasaeedstudio.com</p>
	              </div>
	              <div class="col-md-4 address">
	                <h3><span>To</span>John Doe</h3>
	                <p>95 Folsom Ave, Suite 600</p>
	                <p>San Francisco, CA 94107</p>
	               <p><span>Phone:</span> (804) 123-5432</p>
	                <p><span>Email:</span> info@almasaeedstudio.com</p>
	              </div>
	              <div class="col-md-4 address">
	                <h3><span>Invoice</span> #002465</h3>
	                <p><span>Order ID:</span> 4F3S8J</p>
	                <p><span>Payment Due:</span> 2/22/2015 </p>
	                <p><span>Account:</span> 968-34567</p>
	              </div>
	            </div>
	          </div>
	          <div class="pay-table">
	            <table class="table-striped">
	             <thead>
	              <tr>
	                <th>Qty</th>
	                <th>Product</th>
	                <th>Serial #</th>
	                <th>Description</th>
	                <th>Subtotal</th>
	              </tr>
	              </thead>
	              <tbody>
	              <tr>
	                <td>1</td>
	                <td>Call of Duty</td>
	                <td>455-981-221</td>
	                <td>EI snort testosterone trophy driving gloves handsome</td>
	                <td>$15.02</td>
	              </tr>
	              <tr>
	                <td>2</td>
	                <td>Need for Speed IV</td>
	                <td>235-981-221</td>
	                <td>Sed ut perspiciatis unde omnis </td>
	                <td>$10.32</td>
	              </tr>
	              <tr>
	                <td>3</td>
	                <td>Monsters DVD</td>
	                <td>435-921-241</td>
	                <td>Iste natus error sit voluptatem accusantium</td>
	                <td>$10.70</td>
	              </tr>
	              <tr>
	                <td>4</td>
	                <td>Call of Duty</td>
	                <td>675-021-691</td>
	                <td>Totam rem aperiam, eaque</td>
	                <td>$23.99</td>
	              </tr>
	              </tbody>
	            </table>
	          </div>
	          <div class="pay-method">
	            <div class="row">
	              <div class="col-sm-6">
	               <div class="pay">
	                <h2>Payment Methods</h2>
	                <ul>
	                  <li><a href="#"><img alt="" src="images/payment01.png"></a></li>
	                  <li><a href="#"><img alt="" src="images/payment02.png"></a></li>
	                  <li><a href="#"><img alt="" src="images/payment03.png"></a></li>
	                  <li><a href="#"><img alt="" src="images/payment04.png"></a></li>
	                </ul>
	                <div class="clearfix"></div>
	                </div>                
	              </div>
	              <div class="col-sm-6">
	                <div class="pay pay1">
	                <h2>Amount Due 2/22/2014</h2>
	                <p>Subtotal:<span>$250.30</span></p>
	                <p>Tax (9.3%)<span>$10.34</span></p>
	                <p>Shipping:<span>$5.80</span></p>
	                <div class="total">                  
	                <p>Total:<span>$265.24</span></p>
	                </div>
	                </div>
	                 <div class="clearfix"></div>
	                
	              </div>                
	                <div class="clearfix"></div>
	            </div>
	            <div class="row payment-btns">
	              <div class="col-sm-5">
	              <div class="print">
	              <a href="#">
	               <div class="print-in">
	               <img src="images/print-icon.png" alt="">
	             </div>Print
	             </a>
	             </div>
	              </div>
	              <div class="col-sm-7 add">
	                <div class="added-user-rt">
	              <a href="#">
	               <div class="added-user-rt-in">
	               <img src="images/pdf-icon.png" alt="">
	             </div>generate pdf
	             </a>
	             </div>
	             <div class="added-user-rt">
	              <a href="#">
	               <div class="added-user-rt-in">
	               <img src="images/payment-icon.png" alt="">
	             </div>Submit payment
	             </a>
	             </div>
	              </div>
	            </div>
	          </div>
	        </div>
			</div>
			<div class="clearfix"></div>
		  </div>
	   </div>
	</section>	
@stop