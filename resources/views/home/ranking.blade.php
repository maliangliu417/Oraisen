@extends('layouts.home_default')

@section('styles')
<style type="text/css">
    #myList1 .state-users .rank-row2{
        display: block;
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
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".custom-select3").each(function () {
                $(this).wrap("<span class='select-wrapper3'></span>");
                $(this).after("<span class='holder'></span>");
            });
            $(".custom-select3").change(function () {
                var selectedOption = $(this).find(":selected").text();
                $(this).next(".holder").text(selectedOption);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: 'select/state',
                    data: {state:selectedOption},
                    type: 'POST',
                    success: function(data) {                    
                        var users = data['userByState'];
                        html = '';
                        var j;
                        
                        if(users.length == 0)
                            html += '<h2 style="text-align:center;">No users!</h2>';
                        else{
                            for(var i = 0; i < users.length; i++)
                            {
                                j = i + 1;
                                html += '<div class="rank-row2 rank';
                                html += j;
                                html += '">';
                                html += '<div class="col-xs-9 user-row"><div class="user-left1"><a href="#"><img src="';
                                html += users[i].accImgUrl;
                                html += '" /></a></div><div class="user-middle2"><a href="#"><h1>';
                                html += users[i].usrFrsName;
                                html += '  ';
                                html += users[i].usrLstName;
                                html += '</h1></a></div></div><div class="col-xs-3 rank-row"><h3>';
                                html += j;
                                html += '</h3></div><div class="clearfix"></div></div>';

                            }
                        }
                        
                        $('.state-users').html(html);

                            

                    },
                    error:function(error)
                    {console.log(error);}
                }); 

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
    <!--viewall tab1 -->
    <script type="text/javascript">
        $(document).ready(function () {
            size_li = $("#myList .rank-row2").size();
            x = 7;
            $('#myList .rank-row2:lt(' + x + ')').show();
            $('#loadMore').click(function () {
                $('#myList .rank-row2').show();
            });

        });
    </script>
    <!--viewall end-->
    <!--viewall tab2-->
    <script type="text/javascript">
        $(document).ready(function () {
            size_li = $("#myList1 .rank-row2").size();
            x = 10;
            $('#myList1 .rank-row2:lt(' + x + ')').show();
            $('#loadMore1').click(function () {
                $('#myList1 .rank-row2').show();
            });
        });
    </script>
    <!--viewall end-->
@stop

@section('pageContainer')	
	<div class="market-top">
        <div class="container1">
          <div class="top-h">
            <div class="marketplace">
                <h2>Rankings</h2>
            </div> 
          </div>           
        </div>
    </div>
    <div class="content3">
        <div class="container1">
            <div class="rank row">
                <div class="col-sm-12 rank-tab">
                    <div role="tabpanel">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs rank-list" role="tablist">
                            <li role="presentation" class="active"><a href="#overall" aria-controls="overall" role="tab" data-toggle="tab">Overall Rankings</a></li>
                            <li role="presentation"><a href="#staterank" aria-controls="staterank" role="tab" data-toggle="tab">State Rankings</a></li>

                        </ul>



                        <div class="clearfix"></div>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="overall">
                                <div class="row">
                                    <div class="col-sm-4 ranking2 col-sm-push-4">
                                        @if(isset($usersByOverall[0]))
                                            <div class="crown-user1 crown-user">
                                                <div class="crown1">
                                                    <a href="#"><i class="crown1"><img src="images/crown1.png" alt="Golden Crown" /></i></a>
                                                </div>
                                                <a href="#">                                                    
                                                    <img src="{!! $usersByOverall[0]->accImgUrl !!}" alt="Kevin Hockney" />                                             
                                                </a>
                                                <a href="#"> <h1>{!! $usersByOverall[0]->usrFrsName !!} {!! $usersByOverall[0]->usrLstName !!}</h1></a>
                                                <h4>{!! $usersByOverall[0]->usrCountry !!}</h4>
    											<h2>1</h2>
                                                <h3>Ranking</h3>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-4 ranking1 col-sm-pull-4">
                                        @if(isset($usersByOverall[1]))
                                            <div class="crown-user">
                                                <div class="crown">
                                                    <a href="#"> <i class="crown2"><img src="images/crown2.png" alt="Golden Crown" /></i></a>
                                                </div>
                                                <a href="#">                                     
                                                    <img src="{!! $usersByOverall[1]->accImgUrl !!}" alt="Kevin Hockney" />
                                                </a>
                                                <a href="#"><h1>{!! $usersByOverall[1]->usrFrsName !!} {!! $usersByOverall[1]->usrLstName !!}</h1></a>
                                                <h4>{!! $usersByOverall[1]->usrCountry !!}</h4>
    											                          <h2>2</h2>
                                                <h3>Ranking</h3>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-sm-4 ranking1">
                                        @if(isset($usersByOverall[2]))
                                            <div class="crown-user crown-user3">
                                                <div class="crown2">
                                                    <a href="#"><i class="crown3"><img src="images/crown3.png" alt="Golden Crown" /></i></a>
                                                </div>
                                                <a href="#">
                                                    <img src="{!! $usersByOverall[2]->accImgUrl !!}" alt="Kevin Hockney" />          
                                                </a>
                                                <a href="#"><h1>{!! $usersByOverall[2]->usrFrsName !!} {!! $usersByOverall[2]->usrLstName !!}</h1></a>
                                                <h4>{!! $usersByOverall[2]->usrCountry !!}</h4>
    										                                 	<h2>3</h2>
                                                <h3>Ranking</h3>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="row" id="myList">
                                    <div class="container-fluid">
                                        <div class="user-ranking-list">
                                            <div class="user-ranking-list1">
                                                <div class="rank-row1">
                                                    <div class="col-xs-9 user-row">
                                                        <h2>user</h2>
                                                    </div>
                                                    <div class="col-xs-3 rank-row">
                                                        <h2>ranking</h2>
                                                    </div>
                                                    <div class="clearfix"></div>

                                                </div>
                                                @foreach($usersByOverall as $index => $user)
                                                    @if($index > 2)
                                                    <div class="rank-row2">
                                                        <div class="col-xs-9 user-row">
                                                            <div class="user-left1"><a href="#"><img src="{!! $user->accImgUrl !!}" alt="Kevin" /></a></div>
                                                            <div class="user-middle1">
                                                                <a href="#"><h1>{!! $user->usrFrsName !!} {!! $user->usrLstName !!}</h1></a>
                                                                <h3>{!! $user->usrCountry !!}</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-3 rank-row">
                                                            <h3>{!! $index + 1 !!}</h3>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="rank-row3" id="loadMore">
                                                <div class="rank-row3-inner">
                                                    <h3>VIEW ALL LIST</h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div><!--fluid-->
                                </div><!--row-->
                            </div><!--tab-panel1-->
                            <div role="tabpanel" class="tab-pane" id="staterank">
                                <div class="select-state">
                                    <label>Select State</label>

                                    <select name="state" class="custom-select3" id="sel">
                                    </select>
                                    <script>
                                        function fill() {
                                            var obj = ({"Data": {"Alabama": "AL", "Alaska": "AK", "Arizona": "AZ", "Arkansas": "AR", "California": "CA", "Colorado": "CO", "Connecticutt": "CT", "Delaware": "DE", "Florida": "FL", "Georgia": "GA", "Hawaii": "HI", "Idaho": "ID", "Illinois": "IL", "Indiana": "IN", "Iowa": "IA", "Kansas": "KS", "Kentucky": "KY", "Louisiana": "LA", "Maine": "ME", "Massachusetts": "MA", "Michigan": "MI", "Minnesota": "MN", "Mississippi": "MS", "Missouri": "MO", "Montana": "MT", "Nebraska": "NE",
                                                    "Nevada": "NV", "New Hampshire": "NH", "New Jersey": "NJ", "New Mexico": "NM", "New York": "NY", "North Carolina": "North Carolina", "North Dakota": "ND", "Ohio": "OH", "Oklahoma": "OK", "Oregon": "OR", "Pennsylvania": "PA", "Rhode Island": "RI", "South Carolina": "SC", "South Dakota": "SD", "Tennessee": "TN", "Texas": "TX", "Utah": "UT", "Vermont": "VT", "Virginia": "VA", "Washington": "WA", "West Virginia": "WV", "Wisconsin": "WI", "Wyoming": "WY"
                                                }});
                                            var s = document.getElementById('sel');
                                            var i = 0;
                                            for (var propertyName in obj.Data) {
                                                sel.options[i++] = new Option(propertyName, obj.Data[propertyName], true, false);
                                            }

                                        }

                                        fill();
                                    </script>
                                </div>
                                <div class="row" id="myList1">
                                    <div class="container-fluid">
                                        <div class="state-ranking-list">
                                            <div class="user-ranking-list1">
                                                <div class="rank-row1">
                                                    <div class="col-xs-9 user-row">
                                                        <h2>user</h2>
                                                    </div>
                                                    <div class="col-xs-3 rank-row">
                                                        <h2>ranking</h2>
                                                    </div>
                                                    <div class="clearfix"></div>

                                                </div>
                                                <div class="state-users">
                                                    
                                                </div>                                               
                                            </div><!--rank-list1-->
                                            <div class="rank-row3" id="loadMore1">
                                                <div class="rank-row3-inner">
                                                    <h3>VIEW ALL LIST</h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div><!--fluid-->
                                </div><!--row-->



                            </div><!--tab panel-->


                        </div><!--tab-content-->

                    </div><!--tab-pabel2-->
                </div>


            </div><!--ranking-->
        </div><!--container-->
@stop