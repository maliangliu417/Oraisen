@extends('layouts.admin_default')

@section('pageContainer')
<div class="col-sm-9 market-right">
	  <div class="row dolor-rate">
	  
	  <div class="col-sm-4 dolar-col">
		<div class="col-sm-1 admin-dolor-sign"><a href="#">$</a></div>
		<div class="col-sm-11 admin-dolor-sale">
			<p>Monthly Sales</p>
			<h2><a href="#" >5,366,832</a></h2>
		</div>
	  </div>
	  
	  <div class="col-sm-4 dolar-col">
		<div class="col-sm-1 admin-dolor-sign"><a href="#">$</a></div>
		<div class="col-sm-11 admin-dolor-sale">
			<p>Daily Income</p>
			<h2><a href="#">1,867,678</a></h2>
		</div>
	  </div>
	  
	  <div class="col-sm-4 dolar-col">
		<div class="col-sm-1 admin-dolor-sign"><a href="#">$</a></div>
		<div class="col-sm-11 admin-dolor-sale">
			<p>Yearly Costs</p>
			<h2><a href="#">18,454,545</a></h2>
		</div>
	  </div>
	   
	
		
		
	  </div>
	  <div class="row">
		<div class="col-sm-4 order-main">
		<div class="order">ORDER</div>
		<div class="order-list">
		<ul>
		<li>Order Today  <span>20</span></li>
		<li>Pending Today <span>20</span></li>
		<li>Completed Today  <span>20</span></li>
		<li>Orders Yesterday <span>20</span></li>
		<li>Completed Yesterday <span>20</span></li>
		<li>Month to date  Total <span>20</span></li>
		<li>Year to Date Total  <span>20</span></li>
		</ul>
		</div>
			
		</div>
		
		<div class="col-sm-4 order-main">
		<div class="order">STATISTICS</div>
		<div class="order-list">
		<ul>
		<li>Active Clients <span>20</span></li>
		<li>Unpaid invoices<span>20</span></li>
		<li>Overdue Invoices  <span>20</span></li>
		<li>Pending Transfer Domains <span>20</span></li>
		<li>Suspended Services <span>20</span></li>
		<li>Uninvoiced Billable Item <span>20</span></li>
		<li>Valid Quotes   <span>20</span></li>
		</ul>
		</div>
			
		</div>
		
		<div class="col-sm-4 order-main">
		<div class="order">TICKETS</div>
		<div class="order-list">
		<ul>
		<li>New Tickets   <span>5</span></li>
		<li>Priority Tickets <span>5</span></li>
		<li>Active Tickets  <span>5</span></li>
		<li>Resolved Tickets <span>70</span></li>
		<li>Closed Tickets <span>104</span></li>
		<li>Escalated Tickets<span>22</span></li>
		<li>Reopened Tickets  <span>0</span></li>
		</ul>
		</div>
			
		</div>
		
	  </div>
	  <div class="row">
		<div class="col-sm-12 areachart-main">
			<div class="area-chart">
			<p><img src="images/areachart-icon.png" alt=""/>
			AREA CHART</p>
			</div>
			
		</div>
		<div class="col-sm-12">
			<div class="chart-wrapper">
      <div class="chart-title">
        Pageviews by browser (past 24 hours)
      </div>
      <div class="chart-stage">
        <div id="chart-01"></div>
      </div>
      <div class="chart-notes">
        
      </div>
    </div>
		</div>
	  </div>
	  <div class="row">
		<div class="col-sm-6 task-panel">
			<div class="order">Task Panel</div>
		<div class="order-list">
		<ul>
		<li>Calendar updated     <span>Just Now</span></li>
		<li>Commented on a post  <span> 4 min. ago</span></li>
		<li>Order 392 shipped  <span>23 min ago</span></li>
		<li>Invoice 653 has been paid <span>46 min ago</span></li>
		<li>A new user has been added <span>1 hour ago</span></li>
		<li> Completed task: "pick up dry cleaning"<span>2 hour ago</span></li>
		<li>Saved the world   <span>Yesterday </span></li>
		<li>fix error on sales page <span>two day ago </span></li>
		
		<li><p><a href="#">view all </a></p></li>			
		
		</ul>
		</div>
		</div>
		<div class="col-sm-6 task-panel">
			<div class="order">Pie Chart</div>
		<div class="order-list">
			<div class="pie-chart">
				<div class="chart-wrapper">
      <div class="chart-title">
        Pageviews by browser (past 5 days)
      </div>
      <div class="chart-stage">
        <div id="chart-02"></div>
      </div>
      <div class="chart-notes">
        Notes go down here
      </div>
    </div>
			</div>
		</div>
		</div>
	  </div>		 
	</div>
@stop