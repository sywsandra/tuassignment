@extends('layouts.frontend') @section('content')

<style type="text/css">
* {
	margin: 0;
	padding: 0;
}

.seatrow {
	text-align: center;
	vertical-align: middle;
	width: 35px;
}

.seat {
	float: left;
	display: block;
	margin: 2px;
	background: #c0c0c0;;
	width: 30px;
	height: 30px;
	border-radius: 5px;
	font-size: 8pt;
}

.empty {
	float: left;
	display: block;
	margin: 2px;
	width: 30px;
	height: 30px;
	border-radius: 5px;
}

.seat-select {
	display: none;
}

.seat-select:checked+.seat {
	background: #facb09;

}

label.occuped {
	background: #F44336;
	background: red;
}

.cinemaHall {
	margin: auto;
	width: 90%;
}

.screen {
	display: block;
	margin: 5px;
	background: black;
	width: 500px;
	height: 20px;
}

.availablediv {
	width: 30px;
	height: 30px;
	background: #c0c0c0;
	display: block;
	border-radius: 10px;
}

.occupieddiv {
	width: 30px;
	height: 30px;
	background: red;
	display: block;
	border-radius: 10px;
}

.selecteddiv {
	width: 30px;
	height: 30px;
	background: #facb09;
	display: block;
	border-radius: 10px;
}

.seatclass p {
	writing-mode: tb-rl;
	-webkit-transform: rotate(180deg);
	-moz-transform: rotate(180deg);
	-o-transform: rotate(180deg);
	-ms-transform: rotate(180deg);
	transform: rotate(180deg);
	white-space: nowrap;
	vertical-align: middle;
}

----------------------------------------------------------
* /

</style>
<script>
var total =0;
function setticketno(e) {
	
	if ($(e).is(':checked'))
	{
		total = total + 1;
	}
	else
	{
		if (total > 0)
		total = total - 1;
	}
	  $('#tickets_no').val(total);
	  $('#txt_tickets_no').val(total);
}
</script>


<!-- #masthead -->
<form id="reservation" method="post"
	action="{{ action('ReservationController@create') }}">
	<section class="section-select-seat-2-featured-header">
		<div class="container">
			<div class="section-content">
				<p>
					 <capitalize>{{$showtime->hall_name}}</capitalize>
					 <strong><capitalize>{{$movie->name}}</capitalize></strong> 
					 <span>{{date('l j F Y h:i:s A', strtotime($showtime->show_time))}} </span>
				</p>
			
			</div>
				
		</div>
	</section>

	<section class="section-page-header">
		<div class="container">
			<h1 class="entry-title">Select Your Seat</h1>
			
		</div>
	</section>

	<section class="section-page-content">
		<div class="container">
			
			<div class="row">

				<div id="primary" class="col-md-8">
				

	<div class="cinemaHall">
  @if (isset($error))
			 <div class="alert alert-warning"> <em>	{{ $message }} </em> </div>
     	@endif
   
     <section id="seats">
							<table>
								<tr>
									<td colspan="30" align="middle">
									<div class="stage-name">
						<h3>{{$showtime->hall_name}}</h3>
						
					</div>	
									<span>Screen</span>
									<div class="screen"></div>
									
									</td>
								
								<tr>
									
									<td colspan="30"><hr></td>
								
								</tr>
     </tr>
								
								
    	<?php
    $row_no = 1;
    foreach ($normal_rows as $row) {
        ?>
    	    <tr>
    	    <?php
        if ($row_no == 1) {
            ?>
    	    <td class="seatclass" rowspan="8"><p>Normal</p>&nbsp;&nbsp;</td>
    	    <?php } $row_no = $row_no +1 ; ?>
    	
    	    
    	    <td class="seatrow"><label>{{$row}}</label></td>
    	    
    	    <?php

for ($i = 1; $i <= 16; $i ++) {
            $finded = false;
            foreach ($occupedSeats as $occupedSeat) {
                if ('N' . $row . $i == $occupedSeat) {
                    $finded = true;
                    break;
                }
            }
            if ($i == 4 || $i == 13) {
                ?>
                <td>&nbsp;&nbsp;
									
									<td>
									
									<td>&nbsp;&nbsp;</td>
                <?php } ?>
              <td class="seatrow"><input id="seat-N{{$row}}{{$i}}"
										class="seat-select" <?php if($finded) echo 'disabled'; ?>
										type="checkbox" onclick="setticketno(this)" value="N{{$row}}{{$i}}" name="seat[]" /> <label
										for="seat-N{{$row}}{{$i}}"
										class="seat <?php if($finded) echo 'occuped'; ?>">{{$i}}</label>
									</td>
            <?php }  ?>
    	    
    	    </tr>
    	<?php } ?>
    	
    	<tr>
									<td colspan="30"><hr></td>
								</tr>
    	
    	<?php
    $row_no = 1;
    foreach ($priority_rows as $row) {
        ?>
    	    <tr>
    	    <?php
        if ($row_no == 1) {
            ?>
    	    <td class="seatclass" rowspan="8"><p>Priority</p>&nbsp;&nbsp;</td>
    	    <?php } $row_no = $row_no +1 ; ?>
    	
    	    
    	    <td class="seatrow"><label>{{$row}}</label></td>
    	    
    	    <?php

for ($i = 1; $i <= 16; $i ++) {
            $finded = false;
            foreach ($occupedSeats as $occupedSeat) {
                if ('P' . $row . $i == $occupedSeat) {
                    $finded = true;
                    break;
                }
            }
            if ($i == 4 || $i == 13) {
                ?>
                <td>&nbsp;&nbsp;
									
									<td>
									
									<td>&nbsp;&nbsp;</td>
                <?php } ?>
              <td class="seatrow"><input id="seat-P{{$row}}{{$i}}"
										class="seat-select" <?php if($finded) echo 'disabled'; ?>
										type="checkbox" onclick="setticketno(this)" value="P{{$row}}{{$i}}" name="seat[]" /> <label
										for="seat-P{{$row}}{{$i}}"
										class="seat <?php if($finded) echo 'occuped'; ?>">{{$i}}</label>
									</td>
            <?php }  ?>
    	    
    	    </tr>
    	<?php } ?>
    		<tr>
    		<td colspan="30">
    		<div class="seat-label">
    		
							<br />
							<ul>

								<li><div class="availablediv"></div> Available</li>
								<li><div class="occupieddiv"></div> Occupied</li>
								<li><div class="selecteddiv"></div> Selected</li>
							</ul>
						</div>
						</td></tr>
    		
    	</table>
						</section>
						<input type="hidden" name="movie" value="{{ $movie_id }}"> 
							<input type="hidden" name="showtime_id" value="{{ $showtime->id }}"> 
						<input
							type="hidden" name="_token" value="{{ csrf_token() }}">

					</div>

						
				</div>
					<div id="secondary" class="col-md-4" style="padding-top:200px">
						<div class="ticket-price">
							<div class="tickets">
							<div class="row">
								<div class="col-md-9">
									<label>No of ticket(s) selected : </label> 
								</div>
								<div class="col-md-2">
								 <strong><input type="text" style="border:none;background:transparent;"
									 disabled name="txt_tickets_no" id="txt_tickets_no" value="0" />
									 <input type="hidden" name="tickets_no" id="tickets_no" value="0" />
									 </strong>
								</div>	
								</div>			
							</div>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Section</th>
										
										<th align="right" style="text-align:right">Price</th>
									</tr>
								</thead>
								<tbody>
									<tr class="select-seat">
										<td>Normal Seats <span>{{$normal_left}} Tickets left</span></td>
										
										<td  align="right">2,000 Kyats <span>Per seat</span></td>
									</tr>
									<tr class="select-seat">
										<td>Priority Seats <span>{{$priority_left}} Tickets left</span></td>
										
										<td  align="right">4,000 Kyats <span>Per seat</span></td>
									</tr>
									
								</tbody>
							</table>
						</div>
					
						<button type="submit" class="btn pull-right btn-default">Select</button>
					</div>

				</div>

			</div>

		</div>
	</section>
</form>

@endsection
