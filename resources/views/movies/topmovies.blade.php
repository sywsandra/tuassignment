<script>
	// Instantiate the Bootstrap carousel
	$('.multi-item-carousel').carousel({
	  interval: false
	});

	// for every slide in carousel, copy the next slide's item in the slide.
	// Do the same for the next, next item.
	$('.multi-item-carousel .item').each(function(){
	  var next = $(this).next();
	  if (!next.length) {
	    next = $(this).siblings(':first');
	  }
	  next.children(':first-child').clone().appendTo($(this));
	  
	  if (next.next().length>0) {
	    next.next().children(':first-child').clone().appendTo($(this));
	  } else {
	  	$(this).siblings(':first').children(':first-child').clone().appendTo($(this));
	  }
	});
	</script>
<div class="container">
<div class="topmovieshighlighter"></div>
						<h4  class="topmovies-title">This Week Movies</h4>
 
 <div class="col-md-12">
      <div class="carousel slide multi-item-carousel" id="theCarousel">
        <div class="carousel-inner">
        
        <?php $first = true; ?>
         @foreach($topmovies as $movie)
       
         <div class="item <?php if ($first) echo 'active';?>">
            <div class="col-xs-4"><a href="{{ url('/movies/'.$movie->id.'/buyticket')}}">
           @if ($movie -> poster !== null) 
				<img 
						src="{{URL::to('/uploads/'. $movie -> poster)}}" class="img-thumbnail img-rounded img-responsive"
						 />
				@else
				
					<img  src="{{URL::to('/img/page-1_img01_original.jpg')}}" class="img-thumbnail img-rounded img-responsive"
				 />
				
				@endif
            
            </a>   </div>
            <div  class="synopsis col-md-8">
          	 <span> <a  href="{{ url('/movies/'.$movie->id.'/buyticket')}}"
            	 class="btn btn-info">Buy ticket</a></span>
            	 <p class="details-title">Movie:</p>
				<p>{{ $movie-> name}}</p>
            		<p class="details-title">Cast:</p>
				<p>{{ $movie-> cast}}</p>

				<p class="details-title">Running Time:</p>
				<p>{{ $movie-> running_time}}</p>

				<p class="details-title">Synopsis:</p>
				<p>{{ $movie-> desc}}</p>
            
            
            	
            	 </div>
         
           
          </div>
            	<?php $first = false; ?>
         @endforeach
          
 	 
          <!--  Example item end -->
        </div>
        <a class="left carousel-control" href="#theCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
        <a class="right carousel-control" href="#theCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
      </div>
    </div>
		&nbsp;&nbsp;
		
			<table width="100%" class="selectmovies">
				<tr>
					<td>
						<div class="highlighter"></div>
						<h5>THRILLER</h5>
					</td>
					
					<td>
						<div class="highlighter"></div>
						<h5>ACTION</h5>
					</td>
					
					<td>
						<div class="highlighter"></div>
						<h5>NEXT</h5>
					</td>
					
					<td>
						<div class="highlighter"></div>
						<h5>TODAY</h5>
					</td>
				</tr>
				<tr style="vertical-align:top">
				 
					<td>
					  <?php foreach($thriller as $movie) {    ?>
					  <div class="selectioncontainer">
					      <div class="row">
					      <div class="col-xs-12 col-sm-5">
					       @if ($movie -> poster !== null) 
        				<img 
        						src="{{URL::to('/uploads/'. $movie -> poster)}}" class="img-responsive img-thumbnail img-rounded"
        						 />
        				@else
        				
        					<img src="{{URL::to('/img/page-1_img06.jpg')}}" class="img-responsive img-thumbnail img-rounded"
        				 />
        				
        				@endif
        				
					      </div>
					      <div class="col-xs-12 col-sm-7">
					      <div class="row">
					      <div class="col-sm-12">
					      <h4>
					       <span> <a  href="{{ url('/movies/'.$movie->id.'/buyticket')}}">
            	 				{{$movie->name}}</a></span>
					      </h4>
					      </div>
					     
					      </div>
					   		{{ str_limit($movie->desc, 100) }}
					      </div>
					    
					      </div>
					      </div>
					      
					      <br/>
				   <?php } ?>
					</td>
				
					<td>
					   <?php foreach($action as $movie) {    ?>
					  <div class="selectioncontainer">
					      <div class="row">
					      <div class="col-xs-12 col-sm-5">
					       @if ($movie -> poster !== null) 
        				<img 
        						src="{{URL::to('/uploads/'. $movie -> poster)}}" class="img-responsive img-thumbnail img-rounded"
        						 />
        				@else
        				
        					<img src="{{URL::to('/img/page-1_img06.jpg')}}" class="img-responsive img-thumbnail img-rounded"
        				 />
        				
        				@endif
        				
					      </div>
					      <div class="col-xs-12 col-sm-7">
					      <div class="row">
					      <div class="col-sm-12">
					      <h4>
					       <span> <a  href="{{ url('/movies/'.$movie->id.'/buyticket')}}">
            	 				{{$movie->name}}</a></span>
					      </h4>
					      </div>
					     
					      </div>
					   		{{ str_limit($movie->desc, 100) }}
					      </div>
					    
					      </div>
					      </div>
					      
					      <br/>
				   <?php } ?>
					</td>
					
					<td>
					   <?php foreach($next_movies as $showtime) {    ?>
					  <div class="selectioncontainer">
					      <div class="row">
					      <div class="col-xs-12 col-sm-5">
					       @if ($showtime->movie-> poster !== null) 
        				<img 
        						src="{{URL::to('/uploads/'. $showtime-> movie -> poster)}}" class="img-responsive img-thumbnail img-rounded"
        						 />
        				@else
        				
        					<img src="{{URL::to('/img/page-1_img06.jpg')}}" class="img-responsive img-thumbnail img-rounded"
        				 />
        				
        				@endif
        				
					      </div>
					      <div class="col-xs-12 col-sm-7">
					      <div class="row">
					      <div class="col-sm-12">
					      <h4>
					       <span> <a  href="{{ url('/movies/'.$showtime->movie->id.'/buyticket')}}">
            	 				{{$showtime->movie->name}}</a></span>
					      </h4>
					      </div>
					     
					      </div>
					   		{{$showtime->hall_name}}
					   		<br />
					   		{{date('l',strtotime($showtime->show_time))}}
					   		<br />
					   			{{date('j F Y',strtotime($showtime->show_time))}}
					      </div>
					    
					      </div>
					      </div>
					      
					      <br/>
				   <?php } ?>
					</td>
					
					<td>
					    <?php foreach($now_showing as $showtime) {    ?>
					   <div class="selectioncontainer">
					      <div class="row">
					      <div class="col-xs-12 col-sm-5">
					       @if ($showtime->movie-> poster !== null) 
        				<img 
        						src="{{URL::to('/uploads/'. $showtime-> movie -> poster)}}" class="img-responsive img-thumbnail img-rounded"
        						 />
        				@else
        				
        					<img src="{{URL::to('/img/page-1_img06.jpg')}}" class="img-responsive img-thumbnail img-rounded"
        				 />
        				
        				@endif
        				
					      </div>
					      <div class="col-xs-12 col-sm-7">
					      <div class="row">
					      <div class="col-sm-12">
					      <h4>
					        <span> <a  href="{{ url('/movies/'.$showtime->movie->id.'/buyticket')}}">
            	 				{{$showtime->movie->name}}</a></span>
					      </h4>
					      </div>
					     
					      </div>
					   		{{$showtime->hall_name}}
					   		<br />
					   		{{date('h:i A',strtotime($showtime->show_time))}}
					   		<br />
					   			{{date('j F Y',strtotime($showtime->show_time))}}
					      </div>
					    
					      </div>
					      </div>
					      
					      <br/>
				   <?php } ?>
					</td>
					
						
				</tr>
			</table>
		</div>


