@extends('layouts.admin_default')

@section('headerStyles')
	{!! Html::style( 'css/style.css' ) !!}
	<style type="text/css">
		a{
			cursor: pointer;
		}
		#tableBody tr{
			float: none;

		}
		#postModal .post-input{
			width: 100%;
			display: block;
			border: 1px solid #666;
			margin: 10px;
			padding: 5px;
		}
		textarea{
			resize:none;
			width: 100%;
			height: 120px;
		}
		.btn-primary{
			float: right;
			width: 200px;
			display: block;
		}
	</style>
@stop

@section('pageContainer')
	<div class="products-modelbox">
        <div class="modal fade" id="postModal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="closediv" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                    <div class="modal-body">   
         
                        <div class="row">
                            <div class="col-sm-4">
                                <h4>Post Owner</h4>
                            </div>
                            <div class="col-sm-8">
                                <span class="post-owner post-input"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <h4>Product Name</h4>
                            </div>
                            <div class="col-sm-8">
                                <span class="product-name post-input"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <h4>Product Description</h4>
                            </div>
                            <div class="col-sm-8">
                                <textarea class="product-description post-input"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <h4>Product Price</h4>
                            </div>
                            <div class="col-sm-8">
                                <span class="product-price post-input"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <h4>Thanks page url</h4>
                            </div>
                            <div class="col-sm-8">
                                <span class="thanks-url post-input"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <h4>Post url</h4>
                            </div>
                            <div class="col-sm-8">
                                <span class="post-url post-input"></span>
                            </div>
                        </div>
                        <div class="row">
                        	<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                        
                    </div>          
                </div>
            </div>
        </div>
    </div>
	<div class="table-data">
		<table id="tableData">
			<thead>
				<tr>
					<th>Owner Name</th>
					<th>Product Name</th>
					<th>Thanks Page Url</th>
					<th>Product Page Url</th>
					<th>Post Date</th>
					<th colspan="3">Action</th>
				</tr>
			</thead>
			<tbody id="tableBody">
				@foreach($products as $product)
					<tr>
						<th>{!!  $product->usrFrsName !!} {!!  $product->usrLstName !!}</th>
						<th>{!!  $product->pdtName !!}</th>
						<th>{!!  $product->pdtTUrl !!}</th>
						<th>{!!  $product->pdtPUrl !!}</th>
						<th>{!!  $product->created_at !!}</th>
						<td><a class="product-detail" post-id="{!! $product->pdtId !!}" title="details" data-toggle="modal" data-target="#postModal"><i class="fa fa-clipboard fa-lg"></i></a></td>
						<td>
							@if($product->pdtPostPermission == 1)
								<a class="post-agree" post-id="{!! $product->pdtId !!}" title="agree" disabled="disabled" style="color:silver">
							@else
								<a class="post-agree" post-id="{!! $product->pdtId !!}" title="agree">
							@endif
							<i class="fa fa-thumbs-up fa-lg"></i></a>
						</td>
						<td><a class="product-delete" post-id="{!! $product->pdtId !!}" title="delete"><i class="fa fa-trash-o fa-lg"></i></a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop

@section('footerJavascript')
	{!! Html::script( 'js/alexDialog.js' ) !!}

	<script type="text/javascript">

	function show_products(products)
    {
        var html = '';

        if(products == '')
            alert('None post products.');
        else{
            for(var i = 0; i < products.length; i++)
            {
                html += '<tr><th>';
                html += products[i].usrFrsName;
                html += ' ';
                html += products[i].usrLstName;
                html += '</th><th>';
                html += products[i].pdtName;
                html += '</th><th>';
                html += products[i].pdtTUrl;
                html += '</th><th>';
                html += products[i].pdtPUrl;
                html += '</th><th>';
                html += products[i].created_at;
                html += '</th><td><a class="product-detail" post-id="';
                html += products[i].pdtId;
                html += '" title="details" data-toggle="modal" data-target="#postModal"><i class="fa fa-clipboard fa-lg"></i></a></td>';
                html += '<td><a class="post-agree" post-id="';
                html += products[i].pdtId;
                html += '" title="agree"';
                if(products[i].pdtPostPermission == 1)
                {
                	html += ' disabled="disabled" style="color:silver"';
                }
                html += '><i class="fa fa-thumbs-up fa-lg"></i></a></td>';
                html += '<td><a class="product-delete" post-id="';
                html += products[i].pdtId;
                html += '" title="delete"><i class="fa fa-trash-o fa-lg"></i></a></td></tr>';
            }
        }
        

        $('#tableBody').html(html);
    }

	$(document).ready(function () {
		$('.post-agree').on('click', function(e){
			var post_id = $(this).attr("post-id");
			var handler = $(this);

			alexDialog({
				"width": 300,
				"title": "Alert",
				"descr": "Do you want to agree post product?",
				"btns": [
					{
						"text": "No",
						"handler": function(){
							
							},
						"background": "green",
						"fontColor": "#fff"
					},
					{
					"text": "Yes",
					"handler": function(){
							if($(this).attr("disabled") != "disabled")
							{
								$.ajaxSetup(
					            {
					                headers:
					                {
					                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					                }
					            });
					            $.ajax({
					                url: "/agree/post",
					                type: "POST",
					                data: {post_id, post_id},
					                success: function(data) {
					                    handler.css("color","silver");
					                    handler.attr("disabled","disabled");
					                },
					                error:function(error)
					                {console.log(error);}          
					            });
							} 
						},
					"background": "green",
					"fontColor": "#fff"
				}],
				"toTop": 280,
				"borderRadius": 3,
				"backgroundColor": "#92cdf8",
				"borderColor": "#999",
				"titleColor": "#333",
				"titleFontSize": 16,
				"titleBackgroundColor": "#faa850",
				"titleBorderColor": "#999",
				"descColor": "#d90001",
				"descSize": 14,
				"descLineHeight": 1.5
			});
				
		});

		$('.product-detail').on('click', function(){
			var post_id = $(this).attr("post-id");

			$.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/detail/product",
                type: "POST",
                data: {post_id, post_id},
                success: function(data) {
                    if(data['status'] == 'none')
                        alert('None');
                    else{
                        var product = data['product'];
                        var buffer = product.usrFrsName;
                        buffer += '  ';
                        buffer += product.usrLstName;
                        $('#postModal .post-owner').html(buffer);
                        $('#postModal .product-name').html(product.pdtName);
                        $('#postModal .product-description').html(product.pdtDescription);                        
                        $('#postModal .product-price').html(product.pdtPrice);
                        $('#postModal .thanks-url').html(product.pdtTUrl);
                        $('#postModal .post-url').html(product.pdtPUrl);

                    }
                },
                error:function(error)
                {console.log(error);}          
            });
		});

		$('.product-delete').on('click', function(){
			var post_id = $(this).attr("post-id");

			alexDialog({
				"width": 300,
				"title": "Warning!",
				"descr": "Do you want to delete really?",
				"btns": [
					{
						"text": "No",
						"handler": function(){
							
							},
						"background": "green",
						"fontColor": "#fff"
					},
					{
					"text": "Yes",
					"handler": function(){
							$.ajaxSetup(
				            {
				                headers:
				                {
				                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				                }
				            });
				            $.ajax({
				                url: "/delete/product",
				                type: "POST",
				                data: {post_id, post_id},
				                success: function(data) {
				                    if(data['status'] == 'fail')
				                    	alert('Fail to delete.');
				                    else if(data['status'] == 'none'){
				                    	alert('None post products.');
				                    	$('#tableBody').html('');
				                    }
				                    else
				                    {
				                    	var products = data['products'];
				                    	show_products(products);
				                    }
				                },
				                error:function(error)
				                {console.log(error);}          
				            });
						},
					"background": "green",
					"fontColor": "#fff"
				}],
				"toTop": 280,
				"borderRadius": 3,
				"backgroundColor": "#92cdf8",
				"borderColor": "#999",
				"titleColor": "#333",
				"titleFontSize": 16,
				"titleBackgroundColor": "#faa850",
				"titleBorderColor": "#999",
				"descColor": "#d90001",
				"descSize": 14,
				"descLineHeight": 1.5
			});

			
		});
	});
	</script>
@stop