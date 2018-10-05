 @extends('layouts.frontend') @section('content')

<style>
#showtime
{
display: block;
padding: 20px;
border: 1pt solid #ccc;
background: #000;
min-height : 400px;
}

/* Style the tab */
.tab {
    float: left;
    font-family: verdana;
    font-size: 10pt;
     border: 1px solid #ccc;
      
    background-color: #f1f1f1;
    background: #000;
    width: 20%;
    height: 300px;
}
.htab {
    left: 20%;
    border-right: 1px solid #ccc;
    border-top: 1pt solid#ccc;
    position :relative;
    background-color: #f1f1f1;
    background: #000;
    width: 80%;
  font-family: verdana;
    font-size: 10pt;
}
.htab li {
border-left: 1pt solid#ccc;
}
.nav-pills li a:hover{
color: black !important;
}



/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
    color: black !important;
}

/* Create an active/current "tab button" class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  
    
    border : 1pt solid #ccc;
    color: #fff;
   
}
/* Style the buttons that are used to open the tab content */
.tab button {
    display: block;
    background-color: inherit;
    color: #facb09;;
    padding: 22px 16px;
    width: 100%;
    border: none;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
      border-bottom: 1px solid #ccc;
      height: 50px;
        vertical-align: center;
}
.tab-pane-row {
    display: block;
    background-color: inherit;
    color: black;
   padding: 22px 16px;
    width: 100%;
    border: none;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
    border-bottom: 1px solid #ccc;
     height: 50px;
     vertical-align: center;
}


.tab-pane-row:hover {
  background: #fff;
  
}
a.tablinks
{
    display: inline-block;
    border-radius: 10px;
    border:1pt solid #337ab7;
    background-color: #337ab7;
    color:#fff;
    font-family: verdana;
    font-size: 10pt;
    padding-left:10px;
    padding-right:10px;
    text-decoration:none;
}
.star-rating {
  line-height:32px;
  font-size:1.25em;
}

.star-rating .fa-star{color: red;}
</style>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6 col-pg-zero">

			    @if ($movie -> poster !== null) 
				<img 
						src="{{URL::to('/uploads/'. $movie -> poster)}}" class="img-responsive img-thumbnail img-rounded"
						 />
				@else
				
					<img  src="{{URL::to('/img/page-1_img01_original.jpg')}}" class="img-responsive img-thumbnail img-rounded"
				 />
				
				@endif

	<div>
	<span style="color:red" id="rating" class="rating" data-current-rating=0 data-icon-bad='fa fa-heart-o' data-icon-good='fa fa-heart'></span>
		</div>
		</div>
	
<div  class="synopsis col-md-6 col-sm-6 col-xs-6 col-pg-zero">
		 <p class="details-title">Photos:</p>
				<ul class="synopsis list-unstyled list-inline photos">
    <?php for ($i = 1; $i <= 3; $i ++) { ?>
    <li class=""><a href="#"><img
							src="{{URL::to('/img/page-1_img06.jpg')}}"
							class="img-thumbnail img-responsive" /></a></li>
    <?php } ?>
</ul>
		 <p class="details-title">Movie:</p>
				<p>{{ $movie-> name}}</p>
				 <p class="details-title">Rating:</p>
				 <div class="row">
    <div class="col-lg-12">
      <div class="star-rating">
        <span class="fa fa-star-o" data-rating="1"></span>
        <span class="fa fa-star-o" data-rating="2"></span>
        <span class="fa fa-star-o" data-rating="3"></span>
        <span class="fa fa-star-o" data-rating="4"></span>
        <span class="fa fa-star-o" data-rating="5"></span>
        <input type="hidden" name="whatever1" class="rating-value" value="2.56">
      </div>
    </div>
  </div>
            		<p class="details-title">Cast:</p>
				<p>{{ $movie-> cast}}</p>

				<p class="details-title">Running Time:</p>
				<p>{{ $movie-> running_time}}</p>

            	
            </div>
   
		

<div class="col-md-12 col-sm-6 col-xs-6 col-pg-zero">
<div id="showtime">

<div>
<div class="htab">
<ul class="nav nav-pills nav-justified">  
  <?php 

  for($i = 0; $i < 7; $i++) {  
     ?>
       <li><a data-toggle="tab" href="#tab_date_{{$i}}"><?php echo date('d F',strtotime("+".$i." day")) ?></a></li>
    
  <?php } ?>

</div>
</div>

<div>
<div class="tab">
@foreach ($halls as $hall)
  <button>{{$hall->name}}</button>
  @endforeach
</div>
</div>

<div class="tabcontent">
<div class="tab-content clearfix">
 <?php 

  for($i = 0; $i < 7; $i++) {        
      ?>  

 <div class="tab-pane <?php if($i==0) { echo 'fade in active';} ?>" id="tab_date_{{$i}}">
 
   @foreach ($halls as $hall)
 <div class="tab-pane-row">
     	&nbsp;
        @foreach ($showtimes as $showtime)
        
        @if ($showtime->hall_id == $hall->id && date('d-m-Y', strtotime($showtime->show_time))== date('d-m-Y',strtotime("+".$i." day")) )
		 <a class="tablinks" href="{{ url('/reservation/bookseat/'.$showtime->id) }}">{{date('h:i A', strtotime($showtime->show_time))}}</a>
  		@endif
		@endforeach
		 
         </div>   @endforeach </div>
 <?php } ?>
  

</div>
</div>
		</div>
</div>
		
</div>
<script>
var $star_rating = $('.star-rating .fa');

var SetRatingStar = function() {
	
  return $star_rating.each(function() {
    if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
      return $(this).removeClass('fa-star-o').addClass('fa-star');
    } else {
      return $(this).removeClass('fa-star').addClass('fa-star-o');
    }
  });
};

		

$(document).ready(function() {
    $star_rating.click(function() {
  	  $star_rating.siblings('input.rating-value').val($(this).data('rating'));
  	 
  	  return SetRatingStar();
  });
});
</script>
@endsection
