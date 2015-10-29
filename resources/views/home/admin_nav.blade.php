<section class="navigation1">  
    <div class="container1">
	   <div class="row">
         <div class="col-sm-4">
          <div class="row">
            <div class="col-xs-2">
            <a href="#" class="logo2">{!! Html::image("images/logo1.png", 'picture') !!}</a>
          </div>
          <div class="col-xs-10">
            @if($title == 'Dashboard')
             <div class="menu-drop1"><i class="fa fa-search"></i><input type="text"/></div> 
            @endif
          </div>
          </div>
        </div>
    <div class="col-sm-4">
     <ul class="top-menu">
        @if($title == 'User Profile' || $title == 'Dashboard' || $title == 'Market Place')
          @if($title == 'User Profile')
             <li><a href="{!!url('profile')!!}" class="active">My profile</a></li>
          @else
            <li><a href="{!!url('profile')!!}">My profile</a></li>
          @endif
          @if($title == 'Dashboard')
            <li><a href="{!!url('dashboard')!!}" class="active">Dashboard</a></li>
          @else
            <li><a href="{!!url('dashboard')!!}">Dashboard</a></li>
          @endif
          <!--<li><a href="">My Profile</a></li>-->
          @if($title == 'Market Place')
            <li><a href="{!!url('marketer')!!}" class="active">Marketplace</a></li> 
          @else 
            <li><a href="{!!url('marketer')!!}">Marketplace</a></li> 
          @endif
        @endif
     </ul>
		   <div class="dropdown">
            <div class="menu-drop">{!! Html::image("images/menu-drop.png", 'picture') !!}</div>
			<div class="menu-dropdown">
			   <ul>
            @if($title == 'User Profile')
			         <li><a href="{!!url('profile')!!}" class="active">My profile</a></li>
            @else
              <li><a href="{!!url('profile')!!}">My profile</a></li>
            @endif
            @if($title == 'Dashboard')
  				    <li><a href="{!!url('marketer')!!}" class="active">Dashboard</a></li>
            @else
              <li><a href="{!!url('marketer')!!}">Dashboard</a></li>
            @endif
  				  <!--<li><a href="">My Profile</a></li>-->
            @if($title == 'Market Place')
              <li><a href="{!!url('marketer')!!}" class="active">Marketplace</a></li>	
            @else	
              <li><a href="{!!url('marketer')!!}">Marketplace</a></li> 
            @endif
			   </ul>			
			</div>
		   </div>
		   <div class="clearfix"></div>
		 </div>
	     <div class="col-sm-4">
        <ul class="icons">
         <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-usd"></i></a>
                  <div class="sale-drop dropdown-menu">
                    <h2>Sales</h2>
                    <a href="#"><div class="sale-box">
                      <div class="sale-lf">
                        {!! Html::image("images/sale01.jpg", 'picture') !!}
                      </div>
                      <div class="sale-rt">
                      <h2>2 New Sales<span>1 Minute ago</span></h2>
                      <p>A total of $120 was earned</p>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    </a>
                    <a href="#"><div class="sale-box">
                      <div class="sale-lf">
                        {!! Html::image("images/sale02.jpg", 'picture') !!}
                      </div>
                      <div class="sale-rt">
                      <h2>1 New Sales<span>45 Minute ago</span></h2>
                      <p>A total of $60 was earned</p>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    </a>
                    <a href="#"><div class="sale-box">
                      <div class="sale-lf">
                        {!! Html::image("images/sale03.jpg", 'picture') !!}
                      </div>
                      <div class="sale-rt">
                      <h2>1 New Sales<span>45 Minute ago</span></h2>
                      <p>A total of $80 was earned</p>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    </a>
                    <a href="#"><div class="sale-box">
                      <div class="sale-lf">
                        {!! Html::image("images/sale04.jpg", 'picture') !!}
                      </div>
                      <div class="sale-rt">
                      <h2>2 New Sales<span>45 Minute ago</span></h2>
                      <p>A total of $120 was earned</p>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    </a>
                    <a href="#"><div class="sale-box">
                      <div class="sale-lf">
                        {!! Html::image("images/sale05.jpg", 'picture') !!}
                      </div>
                      <div class="sale-rt">
                      <h2>1 New Sales<span>45 Minute ago</span></h2>
                      <p>A total of $60 was earned</p>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    </a>
                    <div class="seeallsale"><a href="#">See all sales</a>
                    </div>
                  </div>
         </li>
         <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">{!! Html::image("images/message.png", 'picture') !!}</a>
           <div class="sale-drop dropdown-menu">
                    <h2>Private messages</h2>
                    @foreach($msgs as $msg)
                      <a href="{!!url('mail')!!}">
                        <div class="sale-box">
                          <div class="sale-lf">
                            {!! Html::image(url($msg->accImgUrl), 'picture') !!}
                          </div>
                          <div class="sale-rt">
                            <h2>{!! $msg->usrFrsName !!} {!! $msg->usrLstName !!}<span>1 Hours ago</span></h2>
                            <p>{!! $msg->malSubject !!} ...</p>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      </a>
                    @endforeach
                    <div class="seeallsale"><a href="{!!url('mail')!!}">See all messages</a>
                    </div>
                  </div>
         </li>
         <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">{!! Html::image("images/notification.png", 'picture') !!}</a>
              <div class="sale-drop dropdown-menu">
                    <h2>Invoices</h2>
                    <a href="{!!url('invoices')!!}"><div class="sale-box">
                      <div class="sale-lf">
                        {!! Html::image("images/notification01.jpg", 'picture') !!}
                      </div>
                      <div class="sale-rt">
                      <h3>KTM Bikes in Germany accepted your invoice<span>19 hours ago</span></h3>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    </a>
                    <a href="{!!url('invoices')!!}"><div class="sale-box">
                      <div class="sale-lf">
                        {!! Html::image("images/notification02.jpg", 'picture') !!}
                      </div>
                      <div class="sale-rt">
                      <h3>Giant accepted your invoice<span>19 hours ago</span></h3>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    </a>
                    <a href="{!!url('invoices')!!}"><div class="sale-box">
                      <div class="sale-lf">
                        {!! Html::image("images/notification03.jpg", 'picture') !!}
                      </div>
                      <div class="sale-rt">
                      <h3>Smart accepted your invoice<span>19 hours ago</span></h3>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    </a>
                    <a href="{!!url('invoices')!!}"><div class="sale-box">
                      <div class="sale-lf">
                        {!! Html::image("images/notification04.jpg", 'picture') !!}
                      </div>
                      <div class="sale-rt">
                      <h3>Yamaha LTD accepted your invoice<span>9 hours ago</span></h3>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    </a>
                    <a href="{!!url('invoices')!!}"><div class="sale-box">
                      <div class="sale-lf">
                        {!! Html::image("images/notification05.jpg", 'picture') !!}
                      </div>
                      <div class="sale-rt">
                      <h3>Logitech accepted your invoice<span>19 hours ago</span></h3>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    </a>
                    <div class="seeallsale"><a href="{!!url('invoices')!!}">See all  Invoices</a>
                    </div>
                  </div>  
         </li>
         <li class="profile"><a>{!! Html::image("images/profile-icon.png", 'picture') !!}
              <span><!--<i class="fa fa-angle-down"></i>--></span></a>
            <ul class="dropdown1">
             <li class="myprofile"><a href="{!!url('profile')!!}">My Profile</a></li>
             <li class="board"><a href="{!!url('dashboard')!!}">Dashboard</a></li>
             <li class="market"><a href="{!!url('marketer')!!}">Marketplace</a></li>
			       <li class="ranknew"><a href="{!!url('ranking')!!}">Ranking</a></li>
             <li class="statistics"><a href="{!!url('statistic')!!}">Statistics</a></li>
             <li class="setting"><a href="{!!url('setting')!!}">Settings</a></li>
             <li class="logout"><a href="{!!url('logout')!!}">Logout</a></li>
          </ul>
         </li>
      </ul>
     </div>
	     <div class="clearfix"></div>
	   </div><!--row-->
     </div><!--container-->    
 </section>