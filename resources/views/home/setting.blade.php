@extends('layouts.home_default')

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
                
                $('#show-dropdown2').click(function(){
                    $(".dropdown2").toggle();
                    $(this).toggleClass('open');
                });
                
                $(document).mouseup(function ()
                {
                    $(".dropdown2").hide();
                    $('#show-dropdown2').removeClass('open');
                });
                
                $("#show-dropdown2").mouseup(function ()
                {
                    return false
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
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".custom-select5").each(function(){
            $(this).wrap("<span class='select-wrapper5'></span>");
            $(this).after("<span class='holder'></span>");
        });
        $(".custom-select5").change(function(){
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
	<div class="market-top">
            <div class="container1">
			     <div class="top-h">
                        <div class="marketplace">
                            <h2>Settings</h2>
                        </div>
					</div>
            </div>
        </div>	
        <section class="content3">
		     <div class="container1">
			    <div class="settings">
				   <div role="tabpanel" class="settingtabmain">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs settingtabs" role="tablist">
    <li role="presentation" class="active"><a href="#acct-detail" aria-controls="acct-detail" role="tab" data-toggle="tab"><i class="fa fa-user"></i>Account Details</a></li>
    <li role="presentation"><a href="#acct-setting" aria-controls="acct-setting" role="tab" data-toggle="tab"> <i class="fa fa-gear"></i>Account Settings</a></li>
    <li role="presentation"><a href="#notification" aria-controls="notification" role="tab" data-toggle="tab"><i class="fa fa-envelope"></i>Notifications</a></li>  
  </ul>
  <!-- Nav tabs -->
   <div class="tab-content col-sm-7">
    <div role="tabpanel" class="tab-pane active" id="acct-detail">
    <div class="acct_detail">
    <h2>Account Details</h2>
    {!! Form::open(array('url' => 'update/profile', 'method' => 'post', 'class' => 'saveForm', 'id' => 'saveForm' )) !!}
        <div class="formrow1">
            <label>First Name:*</label><input type="text" placeholder="Juan" name="usrFrsName">
        <div class="clearfix"></div>
        </div>
        <div class="formrow1">
            <label>Last Name:*</label><input type="text" placeholder="Martinez" name="usrLstName" />
        <div class="clearfix"></div>
        </div>
        <div class="formrow1">
            <label>Address:*</label><textarea placeholder="118 Virginia Park"></textarea>
        <div class="clearfix"></div>
        </div>
        <div class="formrow1">
            <label>City:*</label><input type="text" placeholder="Fort Pierce"/>
        <div class="clearfix"></div>
        </div>
        <div class="formrow1">
            <label>State:*</label><input type="text" placeholder="Florida"/>
        <div class="clearfix"></div>
        </div>
        <div class="formrow1">
            <label>Postal Code:*</label><input type="text" placeholder="34947" name="usrZipcode" />
        <div class="clearfix"></div>
        </div>
        <div class="formrow1">
            <label>Country:*</label>
            <select name="usrCountry" class="custom-select5" id="sel"></select>
        <div class="clearfix"></div>
        </div>
            <input type="submit" class="save" value="save"/>
        <div class="clearfix"></div>
    {!! Form::close() !!}
    </div>
  </div>
   <div role="tabpanel" class="tab-pane" id="acct-setting">...</div>
    <div role="tabpanel" class="tab-pane" id="notification">...</div>
  </div><!--tab content-->
  <div class="col-sm-5">
   <div class="profileimg">
    <h3>Profile Picture:</h3>
    {!! Html::image($img, 'picture') !!}
  <div class="clearfix"></div>
  </div><!--tab panel-->
    </div>    
    <div class="clearfix"></div>
    </div>
				</div>
			 </div>
		  </section>
@stop

@section('customFooterScript')

    {!! Html::script( 'js/jquery.js' ) !!}

    {!! Html::script( 'js/jquery.validate.js' ) !!}

@stop

@section('footerJavascript')
	<!--country jquery-->
        <script>
    function fill() {
        var obj = ({"Data":{"Alabama":"AL","Alaska":"AK","Arizona":"AZ","Arkansas":"AR","California":"CA","Colorado":"CO","Connecticutt":"CT","Delaware":"DE","Florida":"FL","Georgia":"GA","Hawaii":"HI","Idaho":"ID","Illinois":"IL","Indiana":"IN","Iowa":"IA","Kansas":"KS","Kentucky":"KY","Louisiana":"LA","Maine":"ME","Massachusetts":"MA","Michigan":"MI","Minnesota":"MN","Mississippi":"MS","Missouri":"MO","Montana":"MT","Nebraska":"NE",
    "Nevada":"NV","New Hampshire":"NH","New Jersey":"NJ","New Mexico":"NM","New York":"NY","North Carolina":"North Carolina","North Dakota":"ND","Ohio":"OH","Oklahoma":"OK","Oregon":"OR","Pennsylvania":"PA","Rhode Island":"RI","South Carolina":"SC","South Dakota":"SD","Tennessee":"TN","Texas":"TX","Utah":"UT","USA":"UA","Vermont":"VT","Virginia":"VA","Washington":"WA","West Virginia":"WV","Wisconsin":"WI","Wyoming":"WY"
    }});
        var s = document.getElementById('sel');
        var i = 0;
        for(var propertyName in obj.Data) {
        sel.options[i++] = new Option(propertyName, obj.Data[propertyName], true, false);
    }
    }

    fill();
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
                        if(response['status'] == 'success')
                            alert('Update profile successfully.')
                        else
                            alert('Fail to update.')
                    },
                    error:function(error)
                    {console.log(error);}
                }); 

            }
        });

       $( document ).ready(function() {
            $("#saveForm").validate({
                    rules: {

                            usrFrsName: {
                                required: true,
                                minlength: 2
                            },

                            usrLstName: {
                                required: true,
                                minlength: 2
                            },

                            usrZipcode: {
                                required: true,
                                zipcode: true,
                            },

                            usrCountry:"required"
                    },

                    messages: {

                            usrFrsName: {
                                required: "Please enter a firstname",
                                minlength: "Your firstname must consist of at least 2 characters"
                            },

                            usrLstName: {
                                required: "Please enter a lastname",
                                minlength: "Your lastname must consist of at least 2 characters"
                            },

                            usrZipcode : {
                                required: "Please enter a postal code.",
                                zipcode: "Please invalid zipcode."
                            },

                            usrCountry: "Please country."
                    }

            });

            jQuery.validator.addMethod("zipcode", function(value, element) {
              return this.optional(element) || /^\d{5}(?:-\d{4})?$/.test(value);
            }, "Please provide a valid zipcode.");
        });
    </script>
@stop