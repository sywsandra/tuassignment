@extends('layouts.frontend') @section('content')
<style>
#table_receipt
{
border-bottom: #ccc 2pt dotted;
border-top: #ccc 2pt dotted;
background: #fff;
}
</style>
<script>
function showreceipt(id)
{
	var width= 400;
	var height= 600;
	 var url =  '{{ url("/reservation/show/{id}") }}';
     url = url.replace('{id}', id);
	window.open(url,"Receipt","width="+width+",height="+height+
			",scrollbars=no,toolbar=no,screenx=0,screeny=0,location=no,titlebar=no,directories=no,status=no,menubar=no, top= 0,left=200");
	return false;
}
</script>
<section class="section-page-content">
		<div class="container">
			
			<div class="row">
	
				<div id="primary" class="col-md-8">
				<div class="jumbotron">
					<h4> Reservation ID: #<strong>{{sprintf('%08d',sprintf('%08d', $reservation->id))}}</strong> created.</h4>
					<span><a href="{{ url('/') }}">Back to Movies</a> |
					<a 
						onclick='return showreceipt({{$reservation->id}})' href='#'>Print Receipt</a> 
					</span>
					<br />
					</div>
<img  style="background:transparent" width="500px" height="300px"
						src="{{URL::to('/img/sparklabs_checkout.png')}}"
						> 		
				
						</div>
						
						<div id="secondary" class="col-md-4">
						<div class="ticket-price">
							<div class="tickets">
							<span><label>Transaction ID: #<strong>{{sprintf('%08d',sprintf('%08d', $reservation->id))}}</strong></label> </span><br />
							
							<img  style="background:transparent"
						src="{{URL::to('/img/qrcode.png')}}" /><br /><br />
						<span>Total Tickets: <strong>{{$reservation->no_of_tickets}}</strong></span>
						
								
							
							</div>
							<table class="table" id="table_receipt">
							
								<thead>
								<tr>
									<td colspan="3" style="border-bottom: 2pt dotted #ccc;border-collapse: collapse;">
									{{$showtime->hall_name}}
									<br >{{$showtime->movie_name}}
										<span>{{date('l j F Y h:i A', strtotime($showtime->show_time))}}</span>
										<span>{!!$reservation->print_tickets()!!}</span>
									</td>
									
								</tr>
								
									<tr>
										<td>Seat</td>
										<td>Status</td>
										<td style="text-align:right">Price</td>
									</tr>
								</thead>
								<tbody style="border:1pt dotted #ccc">
								
								  @foreach($tickets as $ticket) 
								  <tr >
										<td>{{$ticket->seat_no}}
										<?php if ($ticket->seat_class=='N') { ?>
										<span>(NORMAL)</span>
										<?php } else if ($ticket->seat_class=='P') {?>
										<span>(PRIORITY)</span>
										<?php } ?>
										</td>
										<td>PAID</td>
										<td align="right">{{number_format($ticket->ticket_price,0) }} <span>kyats</span></td>
									</tr>
								  @endforeach
							
								<tr>
									<td>Paid Amount:</td>
									<td>MMK</td>
									<td align="right">
									{{number_format($reservation->total_paid,0)}}<span>kyats</span>
									</td>
								</tr>
								</tbody>
								<tfoot>
								<td colspan="3" align="right">
								<div>
									<span>Booked by : {{$reservation->booking_name}}</span>
									</div>	
									<div>
									<span>Date : {{date('d M Y h:i:s A', strtotime($reservation->created_at))}}</span>
									</div>	
									
								</td>
								
								</tfoot>
							</table>
							
						</div>
					
						
						</div>

						</div>
						</div>
</section>


@endsection