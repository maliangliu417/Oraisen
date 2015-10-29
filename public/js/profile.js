
$( document ).ready(function() {
    $(document).on('click', '.post-info', function(){
        var content = $('#post-content').val();
        var token = $('#profile-token').val();
        $('#post-content').val('');

        if(content != '')
        {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

         	$.ajax({
              	url: '/post_info',
              	data: {content:content, token:token},
              	type: 'POST',
              	success: function(data) {

           //        	var timeline_data = data['timeline_data'];
           //        	var html = '';

           //        	for(var i = 0; i < timeline_data.length; i++)
           //        	{
           //        		html += "<div class='cd-timeline-block cd-timeline-block1'>";
           //        		html += "<div class='cd-timeline-img cd-movie'>";
           //        		html += "<img src='/";
           //        		html += timeline_data[i].type_img;
           //        		html += "'></img></div><div class='cd-timeline-content'><div class='cd-content-in cd-content-in1'>";
         		// 		if( timeline_data[i].type == 0 )
         		// 		{
         		// 			html += "<p class='about-me2'>";
         		// 			html += timeline_data[i].url;
         		// 			html += "</p>";
         		// 		}
         		// 		else if( timeline_data[i].type == 2 )
         		// 		{
         		// 			html += "<video  controls><source src='/";
         		// 			html += timeline_data[i].url;
         		// 			html += "' type='video/mp4'>";
							    // html += "<video  controls><source src='/";
         		// 			html += timeline_data[i].url;
         		// 			html += "' type='video/ogg'>";
							    // html += "<video  controls><source src='/";
         		// 			html += timeline_data[i].url;
         		// 			html += "' type='video/webm'></video>";
         		// 		}
         		// 		else if( timeline_data[i].type == 3 )
         		// 		{
         		// 			html += "<div id='map_canvas";
         		// 			html += i;
         		// 			html += "' class='map_canvas'></div>";
         		// 			html += "<script type='text/javascript'>";
         		// 			html += "function getLocation(){var infoWindowContent = 'zipcode : ";
         		// 			html += timeline_data[i].url;
         		// 			html += "';var map = new google.maps.Map(document.getElementById('map_canvas";
         		// 			html += i;
         		// 			html += "'), {center: new google.maps.LatLng(52.5167, 12.1833),zoom:   6});var geocoder = new google.maps.Geocoder();var infowindow = new google.maps.InfoWindow();var markers = new Array();geocoder.geocode({address: ";
         		// 			html += timeline_data[i].url;
         		// 			html += ", region: 'DE'}, function(result, status) {if (status == 'OK' && result.length > 0) {marker = new google.maps.Marker({ position: result[0].geometry.location,map: map,title: 'click me',});google.maps.event.addListener(marker, 'click', function() {infowindow.setContent(infoWindowContent);infowindow.open(map,marker);});map.setCenter(marker.getPosition());}});} getLocation();</script>";

         		// 		}
         		// 		else
         		// 		{
         		// 			html += "<img src='/";
         		// 			html += timeline_data[i].url;
         		// 			html += "'>";
         		// 		}

         		// 		html += "</div><div class='like'><div class='like-lf'><p><span><a href='#''><i class='fa fa-heart'></i></a></span><span>";
         		// 		html += timeline_data[i].favor_number;
         		// 		html += "</span></p></div><div class='like-lf like-rt'><p><span><i class='fa fa-clock-o'></i></span><span>";
         		// 		html += timeline_data[i].date;
         		// 		html += "</span></p></div><div class='clearfix'></div></div></div><div class='clearfix'></div></div>";
                  	
           //        	}

           //        	$('#cd-timeline').html(html);
                      location.reload();  
              	
              	},
              	error:function(error)
                	{console.log(error);}
         	}); 
        }
        
    });

    $(document).on('click', '.add-user', function(){

      var token = $('#profile-token').val();

        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

        $.ajax({
              url: "/add/friend",
              data: {token:token},
              type: 'POST',
              success: function(data) {

                  if(data['status'] == 'owner')
                    alert("This page is your owner one, so you can't send friend request.");
                  else{
                    alert(data['msg']);
                    $('.request-status').html("pend friend");

                  }
              },
              error:function(error)
                {console.log(error);}
          }); 
    });
    
    $(document).on('keyup', '.search1', function(event){

      if(event.keyCode == 13){

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $.ajax({
              url: "/search/friend",
              data: {usrName:$('.search1').val()},
              type: 'POST',
              success: function(data) {
                  
                  if(data['status'] == 'error')
                    alert('The Username is not existed!');
                  else{
                    location.href = '/profile/' + data['usrName'] ;

                  }
              },
              error:function(error)
                {console.log(error);}
          }); 

      }
    });

    var post_id = '';

    $(document).on('click', '.post_edit', function(event){

    	var id = $(this).attr("id");
    	post_id = id.substring(10);
      var content_id = '.about-me-';
      content_id +=  post_id;

      $('#post-edit-content').val( $(content_id).html() );
    	
    });

    $(document).on('click', '#post-edit-done', function(event){
      var post_content = $('#post-edit-content').val();

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
          url: "/edit/content",
          data: {post_id: post_id, post_content:post_content},
          type: 'POST',
          success: function(data) {
              if(data['result'] == 0)
                alert('None to edit.');
              else
              {
                alert('Edit successfully!');
                var content_id = '.about-me-';
                content_id +=  post_id;
                $(content_id).html(post_content);
              }
              
          },
          error:function(error)
            {console.log(error);}
      }); 

    });

    $(document).on('click', '.post_delete', function(event){

      var id = $(this).attr("id");
      post_id = id.substring(12);
      
      var isGood = confirm('Do you really want to delete this post?');

      if(isGood == true) 
      {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/delete/post",
            data: {post_id: post_id},
            type: 'POST',
            success: function(data) {
                if(data['result'] == 0)
                  alert('Fail to delete.');
                else
                {
                  location.reload();        
                }
                
            },
            error:function(error)
              {console.log(error);}
        }); 

      } 
    });

  });