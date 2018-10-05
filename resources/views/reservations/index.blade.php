@extends('layouts.app') @section('title', '| Movies')

@section('subtitle')
<i class="fa fa-file-movie-o"></i>
&nbsp;Bookings @endsection @section('header')

<ul class="nav nav-tabs navbar-nav navbar-right">

	<li><a
		href="{{ url('/reservation/index') }}">All Bookings</a></li>
	
	<li></li>

</ul>
@endsection
 @section('content')


<div>

	<!-- will be used to show any messages -->
	@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

			
			<div class="text-right"> {{ $reservations->total() }} record(s) found.</div>
			
	<br />

	<div class="table-responsive row">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<td>#</td>
					<td>Name</td>
					<td>Tickets</td>					
					<td>Movie</td>
					<td>Showtime</td>
					<td>Status</td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				@foreach( $reservations as $reservation)
				<tr>
					<td>{{ $reservation->id }}</td>
					<td>{{ $reservation->name }}</td>
					<td>{!! $reservation->print_tickets() !!}</td>					
					<td>{{ $reservation->showtime->movie_name }}</td>
					<td>{{ date('d-m-Y h:i A', strtotime($reservation->showtime->show_time)) }}</td>
					<td>{{ $reservation->status }}</td>

					
					<td>
						<!-- show the nerd (uses the show method found at GET /nerds/{id} -->
						<a class="btn btn-small btn-success" 
						onclick='return showreceipt({{$reservation->id}})' href='#'>Show</a> 
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="pull-right">{!! $reservations->links() !!}</div>
	</div>
</div>

<!-- Modal -->
<link href="{{ asset('css/bookseat.css') }}" rel="stylesheet">
	
<div id="showModal" class="modal fade" >
		<div class="modal-dialog modal-md">
		
		  <div  class="modal-content" >
                   
                    </div>
                    </div>
                    </div>

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
    $(document).ready(function(){
      $("#showModal").on("show.bs.modal", function(e) {
        var id = $(e.relatedTarget).data('target-id');
        var url =  '{{ url("/reservation/show/{id}") }}';
        url = url.replace('{id}', id);
        $.get(url, function( data ) {  
            
          $(".modal-content").html(data.html);
        });

      });
    });
  </script>
@endsection
