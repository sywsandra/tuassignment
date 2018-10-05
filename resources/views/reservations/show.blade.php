
	<link href="{{ asset('css/bookseat.css') }}" rel="stylesheet">
			<link href="{{ asset('css/public.css') }}" rel="stylesheet">
	
	
                
	<div id="secondary" class="col-md-12">
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
			
					