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
@stop

@section('pageContainer')	
	<div class="team-bg">
        <div class="container1">
           <div class="marketplace">
                        <h2>Referrals</h2>
                    </div>               
        </div>
        <div class="container1">
            <div class="row referrals">
                <div class="col-lg-3 col-md-4 col-sm-6 team-item">
                    <div class="team-wrapper">
                        <div class="img-wrapper">
                            <a href="#"><img src="images/oraisen_team-Page.jpg" class="img-responsive center-block" alt="">
                            </a>
                        </div>
                        <div class="text-wrapper">
                            <a href="#"><h4>Adward Smith</h4></a>
                            <div class="team-text-wrapper">
                                <div class="col-xs-9 reduce-padding">State rank</div>
                                <div class="col-xs-3 reduce-padding team-rank">59</div>
                            </div>
                            <div class="team-text-wrapper">
                                <div>
                                    <div class="col-xs-9 reduce-padding">Global rank</div>
                                    <div class="col-xs-3 reduce-padding team-rank">75</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6  team-item">
                    <div class="team-wrapper">
                        <div class="img-wrapper">
                            <a href="#"><img src="images/oraisen_team-Page2.jpg" class="img-responsive center-block" alt=""></a>
                        </div>
                        <div class="text-wrapper">
                            <a href="#"><h4>April Susen</h4></a>
                            <div class="team-text-wrapper">
                                <div class="col-xs-9 reduce-padding">State rank</div>
                                <div class="col-xs-3 reduce-padding team-rank">37</div>
                            </div>
                            <div class="team-text-wrapper">
                                <div>
                                    <div class="col-xs-9 reduce-padding">Global rank</div>
                                    <div class="col-xs-3 reduce-padding team-rank">49</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 team-item">
                    <div class="team-wrapper">
                        <div class="img-wrapper">
                            <a href="#"><img src="images/oraisen_team-Page.jpg" class="img-responsive center-block" alt=""></a>
                        </div>
                        <div class="text-wrapper">
                            <a href="#"><h4>Adward Smith</h4></a>
                            <div class="team-text-wrapper">
                                <div class="col-xs-9 reduce-padding">State rank</div>
                                <div class="col-xs-3 reduce-padding team-rank">15</div>
                            </div>
                            <div class="team-text-wrapper">
                                <div>
                                    <div class="col-xs-9 reduce-padding">Global rank</div>
                                    <div class="col-xs-3 reduce-padding team-rank">25</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6  team-item">
                    <div class="team-wrapper">
                        <div class="img-wrapper">
                            <a href="#"><img src="images/oraisen_team-Page2.jpg" class="img-responsive center-block" alt=""></a>
                        </div>
                        <div class="text-wrapper">
                            <a href="#"><h4>April Susen</h4></a>
                            <div class="team-text-wrapper">
                                <div class="col-xs-9 reduce-padding">State rank</div>
                                <div class="col-xs-3 reduce-padding team-rank">11</div>
                            </div>
                            <div class="team-text-wrapper">
                                <div>
                                    <div class="col-xs-9 reduce-padding">Global rank</div>
                                    <div class="col-xs-3 reduce-padding team-rank">13</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 team-item">
                    <div class="team-wrapper">
                        <div class="img-wrapper">
                            <a href="#"><img src="images/oraisen_team-Page.jpg" class="img-responsive center-block" alt=""></a>
                        </div>
                        <div class="text-wrapper">
                            <a href="#"><h4>Adward Smith</h4></a>
                            <div class="team-text-wrapper">
                                <div class="col-xs-9 reduce-padding">State rank</div>
                                <div class="col-xs-3 reduce-padding team-rank">59</div>
                            </div>
                            <div class="team-text-wrapper">
                                <div>
                                    <div class="col-xs-9 reduce-padding">Global rank</div>
                                    <div class="col-xs-3 reduce-padding team-rank">75</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6  team-item">
                    <div class="team-wrapper">
                        <div class="img-wrapper">
                            <a href="#"><img src="images/oraisen_team-Page2.jpg" class="img-responsive center-block" alt=""></a>
                        </div>
                        <div class="text-wrapper">
                            <a href="#"><h4>April Susen</h4></a>
                            <div class="team-text-wrapper">
                                <div class="col-xs-9 reduce-padding">State rank</div>
                                <div class="col-xs-3 reduce-padding team-rank">37</div>
                            </div>

                            <div class="team-text-wrapper">
                                <div>
                                    <div class="col-xs-9 reduce-padding">Global rank</div>
                                    <div class="col-xs-3 reduce-padding team-rank">49</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 team-item">
                    <div class="team-wrapper">
                        <div class="img-wrapper">
                            <a href="#"><img src="images/oraisen_team-Page.jpg" class="img-responsive center-block" alt=""></a>
                        </div>
                        <div class="text-wrapper">
                            <a href="#"><h4>Adward Smith</h4></a>
                            <div class="team-text-wrapper">
                                <div class="col-xs-9 reduce-padding">State rank</div>
                                <div class="col-xs-3 reduce-padding team-rank">15</div>
                            </div>
                            <div class="team-text-wrapper">
                                <div>
                                    <div class="col-xs-9 reduce-padding">Global rank</div>
                                    <div class="col-xs-3 reduce-padding team-rank">25</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6  team-item">
                    <div class="team-wrapper">
                        <div class="img-wrapper">
                            <a href="#"><img src="images/oraisen_team-Page2.jpg" class="img-responsive center-block" alt=""></a>
                        </div>
                        <div class="text-wrapper">
                           <a href="#"><h4>April Susen</h4></a>
                            <div class="team-text-wrapper">
                                <div class="col-xs-9 reduce-padding">State rank</div>
                                <div class="col-xs-3 reduce-padding team-rank">11</div>
                            </div>

                            <div class="team-text-wrapper">
                                <div>
                                    <div class="col-xs-9 reduce-padding">Global rank</div>
                                    <div class="col-xs-3 reduce-padding team-rank">13</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>      

                <div class="col-lg-3 col-md-4 col-sm-6 team-item">
                    <div class="team-wrapper">
                        <div class="img-wrapper">
                           <a href="#"><img src="images/oraisen_team-Page.jpg" class="img-responsive center-block" alt=""></a>
                        </div>
                        <div class="text-wrapper">
                            <a href="#"><h4>Adward Smith</h4></a>
                            <div class="team-text-wrapper">
                                <div class="col-xs-9 reduce-padding">State rank</div>
                                <div class="col-xs-3 reduce-padding team-rank">59</div>
                            </div>

                            <div class="team-text-wrapper">
                                <div>
                                    <div class="col-xs-9 reduce-padding">Global rank</div>
                                    <div class="col-xs-3 reduce-padding team-rank">75</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6  team-item">
                    <div class="team-wrapper">
                        <div class="img-wrapper">
                            <a href="#"><img src="images/oraisen_team-Page2.jpg" class="img-responsive center-block" alt=""></a>
                        </div>
                        <div class="text-wrapper">
                            <a href="#"><h4>April Susen</h4></a>
                            <div class="team-text-wrapper">
                                <div class="col-xs-9 reduce-padding">State rank</div>
                                <div class="col-xs-3 reduce-padding team-rank">37</div>
                            </div>

                            <div class="team-text-wrapper">
                                <div>
                                    <div class="col-xs-9 reduce-padding">Global rank</div>
                                    <div class="col-xs-3 reduce-padding team-rank">49</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 team-item">
                    <div class="team-wrapper">
                        <div class="img-wrapper">
                            <a href="#"><img src="images/oraisen_team-Page.jpg" class="img-responsive center-block" alt="">
                            </a>
                        </div>
                        <div class="text-wrapper">
                            <a href="#"><h4>Adward Smith</h4></a>
                            <div class="team-text-wrapper">
                                <div class="col-xs-9 reduce-padding">State rank</div>
                                <div class="col-xs-3 reduce-padding team-rank">15</div>
                            </div>
                            <div class="team-text-wrapper">
                                <div>
                                    <div class="col-xs-9 reduce-padding">Global rank</div>
                                    <div class="col-xs-3 reduce-padding team-rank">25</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6  team-item">
                    <div class="team-wrapper">
                        <div class="img-wrapper">
                            <a href="#"><img src="images/oraisen_team-Page2.jpg" class="img-responsive center-block" alt="">
                            </a>
                        </div>
                        <div class="text-wrapper">
                            <a href="#"><h4>April Susen</h4></a>
                            <div class="team-text-wrapper">
                                <div class="col-xs-9 reduce-padding">State rank</div>
                                <div class="col-xs-3 reduce-padding team-rank">11</div>
                            </div>

                            <div class="team-text-wrapper">
                                <div>
                                    <div class="col-xs-9 reduce-padding">Global rank</div>
                                    <div class="col-xs-3 reduce-padding team-rank">13</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                

            </div><!--row end-->
        </div>
    </div><!--team-bg-end-->
@stop