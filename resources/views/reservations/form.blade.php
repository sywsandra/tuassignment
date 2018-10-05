@extends('layouts.frontend') @section('content')
<style>
 input[type='checkbox'] {
  float: left;
  width: 50px;
}
input[type='checkbox'] + label {
  display: block;
  padding-top: 10px;
}

input[type='text'] + label {
  display: block;
}
#primary
{
font-family: tahoma;
font-size:10pt;
}
.panel-heading
{

	font-size:17px;
	font-family: "Montserrat-Light";
	font-weight: bold;
	color:#ff6600;
}
</style>

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
			<h1 class="entry-title">Fill in booking details.</h1>
			
		</div>
	</section>
	<section class="section-page-content">
		<div class="container">
			
			<div class="row">

				<div id="primary" class="col-md-8">
		@if (isset($error))
			 <div class="alert alert-warning"> <em>	{{ $message }} </em> </div>
     	@endif
     	<form id="reservation" method="post" action="{{ action('ReservationController@addReservation') }}">
     	<div class="panel-group">
  <div class="panel panel-default">
   <div class="panel-heading"><h3>Booking Details</h3></div>
    <div class="panel-body">
   
        <input type="hidden" name="movie_id" value="{{ $movie_id }}"> 
       <input type="hidden" name="showtime_id" value="{{ $showtime->id }}"> 
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name">
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email">
      </div>

      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="number" class="form-control" id="phone" name="phone">
      </div>

 <div  class="form-group">
    
        <input type="checkbox" onclick="addtotal()" class="form-control" id="donation" name="donation" />
        
          <label for="donation"  style="color: #286090;">Add 100 kyats to your transaction as donation.</label>
      </div>
  
      
       <div class="form-group">
       
        <?php if(isset($seats)) {
            foreach($seats as $seat) {  ?>
             
            <input type="hidden" name="seat[]" value="<?=$seat;?>"/>
        <?php } } ?>
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      
    
    </div>
  </div>
  <div class="panel panel-default">
     <div class="panel-heading"><h3>Payment Details</h3></div>
    <div class="panel-body">
 
                     <div class="form-group text-center">
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="text-muted fa fa-cc-visa fa-2x"></i></li>
                                <li class="list-inline-item"><i class="fa fa-cc-mastercard fa-2x"></i></li>
                                <li class="list-inline-item"><i class="fa fa-cc-amex fa-2x"></i></li>
                                <li class="list-inline-item"><i class="fa fa-cc-discover fa-2x"></i></li>
                            </ul>
                        </div>
                      
             <div class="form-group">
        <label for="card_name">Card Holder Name</label>
        <input type="text" class="form-control" id="card_name" name="card_name" placeholder="Name of the card holder">
      </div>

      <div class="form-group">
        <label for="card_number">Card Number</label>
        <input type="text" class="form-control" id="card_no" name="card_no"  placeholder="Card Number">
      </div>
         
         <div class="row">
    <div class="col-sm-3">
        <label for="card_number">Expiration</label>
         <div class="row">
       <div class="col-md-5"> <input type="text" class="form-control input-sm"
        id="card_mm" name="card_mm"  placeholder="MM"></div>
        <div class="col-md-7">   <input type="text" class="form-control input-sm" 
        id="card_yy" name="card_yy"  placeholder="YYYY"></div>
     	</div>
      </div>
       <div class="col-sm-3">
        <label for="card_number">CVV</label>
        <input type="text" class="form-control input-sm" id="card_cvv" name="card_cvv"  placeholder="CVV">
        
      </div>
   
      </div>      <br />  
                 
                   <div  class="form-group">
    
        <input type="checkbox" class="form-control" id="term" name="term" />
        
          <label for="term" style="color: #286090;"> &nbsp;I accept Terms & Conditions.</label>
      </div>
                    
    </div>
  
  </div>
 
  <br />
  <div class="pull-right">
  <button type="submit" class="btn btn-primary glyphicon glyphicon-check">&nbsp;Procced Payment</button>
  </div>
</div>
    
 
   
				
				</div>
				
				
					<div id="secondary" class="col-md-4">
						<div class="ticket-price">
							<div class="tickets">
							<h3>Booking Summary</h3>
								Selected : <label>{{$tickets_no}} tickets.</label> 
<input type="hidden" name="tickets_no" id="tickets_no" value="{{$tickets_no}}" />
							</div>
							<table class="table table-hover">
								<thead>
									<tr>
										
										<th width="60%">Seat</th>
										
										<th  style="text-align:right">Price</th>
									</tr>
								</thead>
								<tbody>
								<?php 
							
							         foreach($seats as $seat) {		
							             if ($seat[0]=='N') {
							                 $total = $total +2000;
								?>
								<tr >
										
										<td  width="60%">{{substr($seat,1)}}
										<span>(NORMAL)</span>
										<span>2,000 kyats per seat</span></span>
										</td>
									
										</td  width="20%">
										<td  align="right">2,000</td>
									</tr>
								
								<?php } elseif ($seat[0]='P') { 
								    $total = $total + 4000;
								    ?>
								  
									<tr class="select-seat">
										
										<td>{{substr($seat,1)}}
										<span>(PRIORITY)</span>
												<span>4,000 kyats per seat</span></span>
										</td>
									
										<td  align="right">4,000</span></td>
									</tr>
									
									<?php } } ?>
									<tr >
										<td>Sub-total</td>
								
										<td  align="right"><?php echo number_format($total,0) ?> <span>kyats</span></td>
									</tr>
									<tr>
									<td>Amount Payable</td>
								
									<td align="right"><input type="hidden" style="border:none;background:transparent;"
									 name="total" id="total" value="<?=$total;?>" />
									 <input type="text" style="text-align:right;border:none;background:transparent;"
									 disabled name="total_text" id="total_text" value="<?php echo number_format($total,0) ?> " />
									 <label for="total">kyats</label>
									</td>
								</tr>
								</tbody>
								<tfoot style="background:#abcdef;">
								
								</tfoot>
							</table>
						</div>
					
						
					</div>
				
   </form>
</div></div></section>
<script>
function numberWithCommas(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
}
function addtotal()
{
	
    if ($('#donation').is(':checked'))
    {
     
    	<?php $total = $total + 100;?>     	
    	 $('#total').val(<?= $total; ?>);
     	var total =numberWithCommas( $("#total").val());
     	
           $('#total_text').val(total);
    }
    else
    {
    	<?php 
    	$total = $total - 100;?> 
    	
    	
    	  $('#total').val(<?= $total; ?>);
    	var total = numberWithCommas( $("#total").val());
    	
          $('#total_text').val(total);
    }
}
</script>
@endsection