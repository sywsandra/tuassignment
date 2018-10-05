@extends('layouts.frontend')


@section('content')
<style>
.more, .less {
    font-weight: 600;
    color: #000;
    text-decoration:none;
}
</style>
<script>

$(function(){
 // here the code for text minimiser and maxmiser by faisal khan
   var minimized_elements = $('p.text-viewer');
   
   minimized_elements.each(function(){    
       var t = $(this).text();        
       if(t.length < 100) return;
       
       $(this).html(
           t.slice(0,100)+'<span>... </span><a href="#" class="more"> Read More>> </a>'+
           '<span style="display:none;">'+ t.slice(500,t.length)+' <a href="#" class="less"> << Less </a></span>'
       );
   }); 
   
   $('a.more', minimized_elements).click(function(event){
       event.preventDefault();
       $(this).hide().prev().hide();
       $(this).next().show();        
   });
   
   $('a.less', minimized_elements).click(function(event){
       event.preventDefault();
       $(this).parent().hide().prev().show().prev().show();    
   });
});
</script>
<div class="container">
<br /><br />
    <hgroup class="mb20">
		<h1>Search Results</h1>
		<h2 class="lead"><strong class="text-danger">{{$movies->count()}}</strong> results were found for the search for <strong class="text-danger">{{$search_term}}</strong></h2>								
	</hgroup>

    <section class="col-xs-12 col-sm-6 col-md-12">
     @if ($movies->isEmpty())
No record found.
 @else
 @foreach($movies as $movie)
		<article class="search-result row">
			<div class="col-xs-12 col-sm-12 col-md-3">
				<a href="movies/{{$movie->id}}/buyticket" title="Lorem ipsum" class="thumbnail">
				@if ($movie -> poster !== null) 
				<img
						src="{{URL::to('/uploads/'. $movie -> poster)}}" class="img-responsive"
						class="img-rounded" height="100" width="100" />
				@else
				
					<img src="{{URL::to('/img/page-1_img01_original.jpg')}}" class="img-responsive"
					 alt="Lorem ipsum" />
		
				@endif
				</a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-2">
				<ul class="meta-search">
					<li><i class="glyphicon glyphicon-calendar"></i> <span>{{$movie->showtimes->unique('hall_name')->pluck('hall_name')->implode(', ')}}</span></li>
					<li><i class="glyphicon glyphicon-time"></i> <span><a class="link" href="movies/{{$movie->id}}/buyticket">Showtimes</a></span></li>
					<li><i class="glyphicon glyphicon-tags"></i> <span>{{$movie->category}}</span></li>
				</ul>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-7 excerpet">
				<h3><a  href="movies/{{$movie->id}}/buyticket" title="">{{$movie->name}}</a></h3>
				<p  class="text-viewer">{{$movie->desc}}</p>						
                <span class="plus"><a href="#" title="Lorem ipsum"><i class="glyphicon glyphicon-plus"></i></a></span>
			</div>
			<span class="clearfix borda"></span>
		</article>
		@endforeach
@endif
      		

	</section>
</div>


						@endsection