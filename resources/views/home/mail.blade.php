@extends('layouts.home_default')

@section('customStyles')
	{!! Html::style( 'css/timeline.css' ) !!}
@stop

@section('styles')
	<style type="text/css">
		.message-form{
			position: fixed;
			display: block;
			float: right;	
			width: 35%;
			background-color: white;
			bottom: 0px;
			right: 0px;
			z-index: 10;
			visibility: hidden;
		}	
		.message-form textarea{
			height: 300px;
			width: 100%;
		}	
		.message-menu{
			display: block;
			background-color: #333;
			color: white;
		}
		.message-name{
			display: block;
			float: left;
			width: 90%;
			background-color: #333;
			height: 25px;

		}
		.message-box{
			border-bottom: 1px solid #CFCFCF;
			position: relative;
		}
		.message-close{
			display: block;
			float: right;
			width: 10%;
			background-color: #333;
			height: 25px;
			border: 1px solid #333;
		}
		.message-form .message-input{
			color: #222;
		}
		.message-content{
			height: 300px;
		}
		.message-send input{
			box-shadow: none;
			background-color: #4D90FE;
			background-image: -moz-linear-gradient(center top , #4D90FE, #4787ED);
			border: 1px solid #3079ED;
			color: #FFF;
			width: 100px;
			margin-left: 30px;
		}
		#msg-error{
			position: absolute;
			top: 0px;
			left: 0px;
		}
		.inbox-table #msg-show{
			display: none;
			background-color: #333;
			color: white;
			border-radius: 5px;
			box-shadow: 0px 1px 1px rgba(47, 39, 29, 0.15);
			margin-top: 56px;
			padding: 0px 10px;
			width: 100%;
		}
		.inbox-table #msg-show .from{
			display: block;
			font-size: 15px;
		}
		.inbox-table #msg-show .subject{
			display: block;
			font-size: 20px;
			border-bottom: 1px solid;
			margin-bottom: 10px;
		}
		.inbox-table #msg-show .content{
			    display: block;
			    border: 1px solid;
			    border-radius: 3px;
			    padding: 10px;
			    margin-top: 30px;
			    width: 100%;
				color: black;
		}
		.inbox-table #msg-show .msg-detail{
			padding: 10px;
		}
		#create-folder{
			display: none;
			width: 50%;
			height: 100px;
			background-color: #777;
			margin: 0 auto;
			position: fixed;
			top: 250px;
			left: 100px;
			z-index: 500;
		}
		#create-folder .row{
			margin-top: 20px;
			padding: 10px;
		}
		#create-folder label{
			text-align: right;
			color: white;
		}
		#create-folder input{
			background-color: white;
			color: #333;
		}
		#create-folder .btn{
			width: 100%;
		}
		.deletebox{
			display: inline-block;
		}
		.friend-form{
			color: white;
			font-size: 20px;
		}
		.friend-form button{
			background-color: #6ec2fe;
			margin-left: 50px;
		}
		.request-content{
			color: white;
		}
		.message-class{
			font-size: 20px;
			color: white;
		}
	</style>
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

	<!--slider toggle -->
	<script type="text/javascript">
	$(document).ready(function(){
	    $(".togglebtn").click(function() {
	$(this).next('.togglediv').slideToggle();
	});
	});   

	</script> 
@stop

@section('pageContainer')
	<div class="market-top">
            <div class="container1">
                        <div class="marketplace">
                            <h2>Messages</h2>
                        </div>
            </div>
	</div>
	<section class="content2">
	   <div class="container1">
	      <div class="row">
		    <div class="col-sm-3">
	        <div class="mail-lf">
	        <div class="compose">
			     <div class="added-user-rt">
	              <a href="#">
	               <div class="added-user-rt-in">
	               <img alt="" src="images/compose-icon.png">
	             </div><span class="msg-compose">Compose Mail</span>
	             </a>
	             </div>
	             </div>
	          <div class="inbox-main">
	              <a href="#" class="inbox-link"><div class="inbox-in inbox active">Inbox<span class="inbox-counter">{!! $counts['inbox'] !!}</span>
	              <div class="clearfix"></div>
	              </div></a>
	              <a href="#" id="draft-link"><div class="inbox-in draft">Draft<span class="draft-counter">{!! $counts['draft'] !!}</span>
	              <div class="clearfix"></div>
	              </div></a>
	              <a href="#" id="sent-link"><div class="inbox-in sent">Sent
	              <div class="clearfix"></div>
	              </div></a>
	              <a href="#" id="trash-link"><div class="inbox-in trash">Trash<span class="trash-counter"></span>
	              <div class="clearfix"></div>
	              </div></a>
	              <a href="#"><div class="inbox-in spam">Spam
	              <div class="clearfix"></div>
	              </div></a>
	      </div>
	      <div class="folder">
	        <div class="folder-box">New Folder<a href="#" id="folder-modal"><span>+</span></a></div>
	        <div class="folder-name" style="display: block;">
	        	@foreach ( $flds as $fld )
	        		<a href="#" id="{!! $fld->mfdName !!}" class="msg-folder"><div class="inbox-in"><img src="images/folder-icon.png" alt=""/>{!! $fld->mfdName !!}</div></a>    		
	            @endforeach
	        </div>
	      </div>
	    </div>
	            <!--mail left end-->
			</div>
			<div class="col-sm-9">	
			    <div class="mail-top">
	        <div class="all">
	        <input type="checkbox"><label>All</label><span class="togglebtn"><i class="fa fa-angle-down"></i></span>
	         <div class="togglediv">
	           <p><span><input type="checkbox"></span>None</p>
	           <p><span><input type="checkbox"></span>Read</p>
	           <p><span><input type="checkbox"></span>Unread</p>
	           <p><span><input type="checkbox"></span>Starred</p>
	           <p><span><input type="checkbox"></span>Unstarred</p>
	         </div>
	      </div>
	     
	      <div class="move">
	       <div class="movetobox">
	        <div class="all">
	        <p>Move</p><span class="togglebtn"><i class="fa fa-angle-down"></i></span>
	        <div class="togglediv" id="move-msg">
	        	@foreach ( $flds as $fld )

	        		<a href="#" id="{!! $fld->mfdName !!}" class="move-group">{!! $fld->mfdName !!}</a>    		

	            @endforeach
	          
	        </div>
	         </div>        
	       </div>
	       <div class="deletebox">
	        <div class="all">
	        <p>Delete</p><span class="togglebtn"><i class="fa fa-angle-down"></i></span>
	        <div class="togglediv" id="delete-folder">
	        	@foreach ( $flds as $fld )

	        		<a href="#" id="{!! $fld->mfdName !!}" class="delete-group">{!! $fld->mfdName !!}</a>    		

	            @endforeach
	          
	        </div>
	         </div>        
	       </div>
	       <div class="morebox">
	        <div class="all">
	        <p>More</p><span class="togglebtn"><i class="fa fa-angle-down"></i></span>
	         <div class="togglediv">
	          <a href="#">Mark as unread</a>
	          <a href="#">Mark as important</a>
	          <a href="#">Add to tasks</a>
	          <a href="#">Add Star</a>
	        </div>
	         </div>
	       
	       </div>
	        <div class="refresh"><a href="#" class="inbox-link"><span><img src="images/refresh.png" alt=""/></span></a></div>
	      </div>
	      <div class="clearfix"></div>
	        </div>
	        <!--mailtop end-->
	        <div class="inbox-table">
	          <table id="example">
	            <tbody>
	            	@foreach ( $mails as $mail )

	            		@if( $mail->malType == 0)
	            			@if( $mail->malRead == 0)
		            			<tr class="new msg-box" id="{!! $mail->malId !!}">
		            		@else
		            			<tr class="msg-box" id="{!! $mail->malId !!}">
		            		@endif	
		            				<td class="checked"><input type="checkbox" value="{!! $mail->malId !!}" class="msg-group"></td>
		            				<td class="checked"><span><label class="checkbox1"><input type="checkbox"><span class="check"></span></label></span></td>
					                <td><div class="inbox-content"><p><span class="from">{!! $mail->usrName !!}</span></p></div></td>
					                <td><div class="inbox-content"><p><span class="subject">{!! $mail->malSubject !!} </span></p></div></td>
					                <td><div class="inbox-content"><p>{!! $mail->created_at !!}</p></div></td>          
					             </tr>
	            		@endif
	            		
	            	@endforeach
	            	<div id="msg-show">
	            		<div class="msg-detail">
	            			<div class="subject"></div>
	            			<div class="row">
	            				<div class="col-sm-8 from"></div>
		            			<div class="col-sm-4 date"></div>
	            			</div>
	            			<div class="content"></div>
	            		</div>
	            		
	            	</div>
	            </tbody>
	          </table>
	        </div>
			</div>
			<div class="clearfix"></div>
		  </div>
	   </div>
	   <div class="message-form">
	   		<div class="message-menu">
	   			<div class="message-name">New Message</div>
	   			<button id="message-close">×</button>
	   		</div>
	   	{!! Form::open(array('url' => 'send_message', 'method' => 'post', 'class' =>'button', 'id' => 'sendMessage')) !!}
	   		
	   		<div class="message-to message-box">
	   			<input type="text" placeholder="To" name="to" id="msg-to" class="message-input">
	   		</div>
	   		<div class="message-subject message-box">
	   			<input type="text" placeholder="Subject" name="subject" id="msg-subject" class="message-input">
	   		</div>
	   		<div class="message-content message-box">
	   			<textarea name="msg" class="message-input" id="msg-content"></textarea>
	   		</div>
	   		<div class="message-send"><input type="submit" value="send"></div>

	   	{!! Form::close() !!}
	   	
	   </div>
	   <div id="create-folder">
	   		<div class="row">
	   			<label class="col-sm-3">File Name : </label>
	   			<input type="text" id="folder-name" class="col-sm-6">
	   		</div>
	   		<div class="btn">
	   			<button id="folder-create">Create</button>
	   			<button id="folder-cancel">Cancel</button>
	   		</div>
	   		
	   	</div>
	</section>
@stop

@section('customFooterScript')
	{!! Html::script( 'js/jquery.js' ) !!}

    {!! Html::script( 'js/jquery.validate.js' ) !!}
@stop

@section('footerJavascript')

	<script type="text/javascript">
		$( document ).ready(function() {
			var draft_select = false;


			function showFolder()
			{

				$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			    });

	            $.ajax({
	                url: 'folder/show',
	                type: 'POST',
	                success: function(data) {

	                	if(data['state'] == 'success'){
	                		var folderNames = data['fldNames'];
	                		var html1 = '', html2 = '', html3 = '';

	                		for(var i = 0; i < folderNames.length; i ++)
	                		{
	                			html1 += '<a href="#" id="';           			
	                			html1 += folderNames[i].mfdName;
	                			html1 += '" class="msg-folder"><div class="inbox-in"><img src="images/folder-icon.png" alt=""/>';
	                			html1 += folderNames[i].mfdName;
	                			html1 += '</div></a>';    		

	                			html2 += '<a href="#" id="';
	                			html2 += folderNames[i].mfdName;
	                			html2 += '" class="move-group">';
	                			html2 += folderNames[i].mfdName;
	                			html2 += '</a>';
 
	                			html3 += '<a href="#" id="';
	                			html3 += folderNames[i].mfdName;
	                			html3 += '" class="delete-group">';
	                			html3 += folderNames[i].mfdName;
	                			html3 += '</a>';
	                		}

	                		$('.folder-name').html(html1);
	                		$('#move-msg').html(html2);
	                		$('#delete-folder').html(html3);
	                		

	                	}
	                },
	                error:function(error)
	                {console.log(error);}
	            }); 
			}

			$(".msg-compose").click(function(){
				$(".message-input").val('');
				$(".message-form").css("visibility", "visible");
			});

			$("#draft-link").click(function(){
				$('#draft-link .inbox-in').addClass('active');
				draft_select = true;

				$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			    });

	            $.ajax({
	                url: 'show/draft',
	                type: 'POST',
	                success: function(data) {
	                		$("#example").css("visibility", "visible");
							$("#msg-show").css("display", "none");
	                		var html = '';

	                		for(var i = 0; i < data['mails'].length; i ++)
	                		{
	                			html += '<tr class="draft-msg" id="';
	                			html += data['mails'][i].malId;
	                			html += '"><td><input type ="checkbox"></td>';
	                			html += '<td><span><label class="checkbox1"><input type="checkbox"><span class="check"></span></label></span></td>';
	                			html += '<td><div class="inbox-content"><p><span>Draft</span></p></div></td>';
	                			html += '<td><div class="inbox-content"><p>';
	                			if(data['mails'][i].malSubject == '')
	                				html += 'no subject';
	                			else
	                				html += data['mails'][i].malSubject;
	                			html += '</p></div></td>';
	                			html += '<td><div class="inbox-content"><p>';
	                			html += data['mails'][i].created_at;
	                			html += '</p></div></td></tr>';
	           
	                		}

	                		$('#example tbody').html(html);

	                },
	                error:function(error)
	                {console.log(error);}
	            }); 

			});

			$("#message-close").click(function(){
				$(".message-form").css("visibility", "hidden");
				var msg_to = $('#msg-to').val();
				var msg_subject = $('#msg-subject').val();
				var msg_content = $('#msg-content').val();

				if( ( msg_to || msg_subject || msg_content) && ( draft_select == false ) )
				{
					$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
				    });

		            $.ajax({
		                url: 'draft/mail',
		                data: {msg_to:msg_to, msg_subject:msg_subject, msg_content:msg_content},
		                type: 'POST',
		                success: function(data) {
		                		var count = data['count'];

		                		if(count == 0)
		                			$('.draft-counter').html('');
		                		else
									$('.draft-counter').html(count);

		                },
		                error:function(error)
		                {console.log(error);}
		            }); 

				}
				
			});

			$(document).on('click', '.msg-folder', function(){
				var id = $(this).attr("id");
				
				$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			    });

	            $.ajax({
	                url: 'folder/select',
	                data: {id:id},
	                type: 'POST',
	                success: function(data) {
	                		var mails = data['mails'];
	                		var html = '';

	                		for(var i = 0; i < mails.length; i ++)
	                		{
	                			if(mails[i].malRead == 0)
	                				html += '<tr class="new msg-box" id="';
	                			else
	                				html += '<tr class="msg-box" id="';

	                			html += mails[i].malId;
	                			html +='">';

	                			html += '<td class="checked"><input type ="checkbox" class="msg-group" value="';
	                			html += mails[i].malId;
	                			html += '"></td>';
	                			html += '<td class="checked"><span><label class="checkbox1"><input type="checkbox"><span class="check"></span></label></span></td>';
	                			html += '<td><div class="inbox-content"><p><span class="from">';
	                			html += mails[i].usrName;
	                			html += '</span></p></div></td>';
	                			html += '<td><div class="inbox-content"><p><span class="subject">';

	                			if(mails[i].malSubject == '')
	                				html += 'no subject';
	                			else
	                				html += mails[i].malSubject;

	                			html += ' </span>';
	                			html += '</p></div></td>';
	                			html += '<td><div class="inbox-content"><p>';
	                			html += mails[i].created_at;
	                			html += '</p></div></td></tr>';
	                			
	                		}
	                		$('#example tbody').html(html);
	                },
	                error:function(error)
	                {console.log(error);}
	            }); 
			});

			$(document).on('click', 'tr.draft-msg', function(){
			
				var id = $(this).attr("id");
				
				$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			    });

	            $.ajax({
	                url: 'select/draft',
	                data: {id:id},
	                type: 'POST',
	                success: function(data) {
	                		var mail = data['mail'];
	                		$(".message-form").css("visibility", "visible");

							$("#msg-to").val( mail.malTo);
							$("#msg-subject").val( mail.malSubject );
							$("#msg-content").val( mail.malContent );
	                },
	                error:function(error)
	                {console.log(error);}
	            }); 

				
			});
			$(document).on("click", ".checked", function(e){
				e.stopPropagation();
			});
			$(document).on("click", "tr.msg-box", function(){
				var id = $(this).attr("id");
				var idElement = "#";
				idElement += id;
				if($(idElement).hasClass('new'))
					$(idElement).removeClass('new');

				$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			    });

	            $.ajax({
	                url: 'select/mail',
	                data: {id:id},
	                type: 'POST',
	                success: function(data) {
	                		var mail = data['mail'];
	                		var counts = data['counts'];

	                		$("#example").css("visibility", "hidden");
							$("#msg-show").css("display", "block");

							if(counts.inbox == 0)
								$('.inbox-counter').html('');
							else
								$('.inbox-counter').html(counts.inbox);

							var from = mail.usrName;
							from += " - ";
							from += mail.malFrom;
	                        $("#msg-show .from").html(from);
							$("#msg-show .date").html(mail.created_at);
							$("#msg-show .subject").html(mail.malSubject);
							$("#msg-show .content").html(mail.malContent);
	                },
	                error:function(error)
	                {console.log(error);}
	            }); 
	/*
				
	*/
			});
			

			$('.move-group').click(function () {
			     var arr = $('.msg-group:checked').map(function () {
			         return this.value;
			     }).get();

			     var id = $(this).attr("id");

			     if(arr.length > 0)
			     {
			     	$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
				    });

		            $.ajax({
		                url: 'folder/move',
		                type: 'POST',
		                data: {fldName:id, groupArr:arr},
		                success: function(data) {	                	

		  					console.log(data['status']);
		                	
		                },
		                error:function(error)
		                {console.log(error);}
		            }); 
			     }
			 });

			$(document).on('click', '.delete-group', function(){
				var id = $(this).attr("id");

				if (!confirm("Are you sure to delete folder?")) {
					return false;
				}
				
				$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
				    });

		            $.ajax({
		                url: 'folder/delete',
		                type: 'POST',
		                data: {fldName:id},
		                success: function(data) {	                	

		  					showFolder();
		                	
		                },
		                error:function(error)
		                {console.log(error);}
		            }); 
			});


			$(".inbox-link").click(function(){
				draft_select = false;
				$('.inbox-link .inbox-in').addClass('active');
				$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			    });

	            $.ajax({
	                url: 'show/inbox',
	                type: 'POST',
	                success: function(data) {
	                		$("#example").css("visibility", "visible");
							$("#msg-show").css("display", "none");

	                		var html = '';

	                		if(data['count'] == 0)
								$('.inbox-counter').html('');
							else
								$('.inbox-counter').html(data['count']);

	                		for(var i = 0; i < data['mails'].length; i ++)
	                		{
	                			if(data['mails'][i].malRead == 0)
	                				html += '<tr class="new msg-box" id="';
	                			else
	                				html += '<tr class="msg-box" id="';

	                			html += data['mails'][i].malId;
	                			html +='">';

	                			html += '<td class="checked"><input type ="checkbox" class="msg-group" value="';
	                			html += data['mails'][i].malId;
	                			html += '"></td>';
	                			html += '<td class="checked"><span><label class="checkbox1"><input type="checkbox"><span class="check"></span></label></span></td>';
	                			html += '<td><div class="inbox-content"><p><span class="from">';
	                			html += data['mails'][i].usrName;
	                			html += '</span></p></div></td>';
	                			html += '<td><div class="inbox-content"><p><span class="subject">';

	                			if(data['mails'][i].malSubject == '')
	                				html += 'no subject';
	                			else
	                				html += data['mails'][i].malSubject;

	                			html += ' </span>';
	                			html += '</p></div></td>';
	                			html += '<td><div class="inbox-content"><p>';
	                			html += data['mails'][i].created_at;
	                			html += '</p></div></td></tr>';
	                			
	                		}
	                		$('#example tbody').html(html);

	                },
	                error:function(error)
	                {console.log(error);}
	            }); 
			});

			
			$("#sent-link").click(function(){
				$('#sent-link .inbox-in').addClass('active');
				draft_select = false;

				$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			    });

	            $.ajax({
	                url: 'show/sent',
	                type: 'POST',
	                success: function(data) {
	                		$("#example").css("visibility", "visible");
							$("#msg-show").css("display", "none");
	                		var html = '';

	                		for(var i = 0; i < data['mails'].length; i ++)
	                		{
	                			if(data['mails'][i].malRead == 0)
	                				html += '<tr class="new msg-box" id="';
	                			else
	                				html += '<tr class="msg-box" id="';

	                			html += data['mails'][i].malId;
	                			html +='">';

	                			html += '<td class="checked"><input type ="checkbox" class="msg-group" value="';
	                			html += data['mails'][i].malId;
	                			html += '"></td>';
	                			html += '<td class="checked"><span><label class="checkbox1"><input type="checkbox"><span class="check"></span></label></span></td>';
	                			html += '<td><div class="inbox-content"><p><span class="from">';
	                			html += data['mails'][i].usrName;
	                			html += '</span></p></div></td>';
	                			html += '<td><div class="inbox-content"><p><span class="subject">';

	                			if(data['mails'][i].malSubject == '')
	                				html += 'no subject';
	                			else
	                				html += data['mails'][i].malSubject;

	                			html += '</span>';
	                			html += '</p></div></td>';
	                			html += '<td><div class="inbox-content"><p>';
	                			html += data['mails'][i].created_at;
	                			html += '</p></div></td></tr>';
	                			
	                		}
	                		$('#example tbody').html(html);

	                },
	                error:function(error)
	                {console.log(error);}
	            }); 
			});

			$(".inbox-in").click(function(){
				$('.inbox-in').removeClass('active');
			});

			$("#folder-modal").click(function(){
				$('#create-folder').css('display', 'block');
			});
			
			$("#folder-create").click(function(){
				
				var fldName = $('#folder-name').val();

				$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			    });

	            $.ajax({
	                url: 'folder/create',
	                type: 'POST',
	                data: {fldName:fldName},
	                success: function(data) {	                	

	                	if(data['state'] == 'exit')
	                		alert(data['alert']);
	                	else
	                	{
	                		$('#create-folder').css('display', 'none');
	                	}
	                	showFolder();
	                },
	                error:function(error)
	                {console.log(error);}
	            }); 	         

			});

			$("#folder-cancel").click(function(){
				$('#create-folder').css('display', 'none');
			});

			$(document).on('click', '.request-accept', function(){
				
				var token =  $(this).parent().attr('usr-token');
				
				$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
				    });

	            $.ajax({
	                url: 'agree/friend',
	                type: 'POST',
	                data: {token:token},
	                success: function(data) {	                	
	                	alert(data['msg']);
	                },
	                error:function(error)
	                {console.log(error);}
	            }); 
			});

			$(document).on('click', '.request-decline', function(){
				
				var token =  $(this).parent().attr('usr-token');
				
				$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
				    });

	            $.ajax({
	                url: 'decline/friend',
	                type: 'POST',
	                data: {token:token},
	                success: function(data) {	                	
	                	alert(data['msg']);
	                },
	                error:function(error)
	                {console.log(error);}
	            }); 
			});
		});
	</script>

	<script type="text/javascript">

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
                            if(response.message == 'send_success')
                            {
                                alert("Send mail successfully!");
                                $(".message-form").css("visibility", "hidden");
                            }
                            else
                                alert(response.message);
                        },
                        error:function(error)
                        {console.log(error);}
                    }); 
                }
        });
         $("#sendMessage").validate({
                rules: {
                    to: {
                            required: true,
                    },
                    subject: {
                            required: true,
                    },
                    msg: {
                            required: true,
                    }
                },
                    messages: {
                            to: "Please enter a receiver!"
                    },
                    messages: {
                            subject: "Please enter a subject!"
                    },
                    messages: {
                            msg: "Please enter a message!"
                    }
                });


	</script>
	
@stop