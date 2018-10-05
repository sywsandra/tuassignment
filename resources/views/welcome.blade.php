@extends('layouts.frontend')


@section('content')
<div class="container">

	<table class="section">
				<tr>
					<td rowspan="2">
						<div class="section_1">
							<img src="{{URL::to('/img/page-1_img01_original.jpg')}}"
								width="700px" height="350px" />

							<div style="padding: 10px">
								<h2>Praesent justo dolor,lobortis quis, lobortis</h2>
								<span> Lorem ipsum dolor sit amet, consectetuer adipiscing elit

									<strong>November 25, 2014 </strong> I Mauris accumsan nulla vel
									diam

								</span>
							</div>
						</div>

					</td>
					<td>
						<div class="section_2">
							<img src="{{URL::to('/img/page-1_img02.jpg')}}" width="400px"
								height="150px" />

							<div style="padding: 10px">
								<h4>Sed in lacus ut enum adipiscing ali</h4>
								<span> <strong>November 25, 2014 </strong>I Mauris accumsan
									nulla

								</span>
							</div>
						</div>
					</td>

				</tr>
				<tr>
					<td>
						<div class="section_2">
							<img src="{{URL::to('/img/page-1_img03.jpg')}}" width="400px"
								height="150px" />

							<div style="padding: 10px">
								<h4>Fauce enusmod consequat ante</h4>
								<span> <strong>November 25, 2014 </strong>I Mauris accumsan
									nulla

								</span>
							</div>
						</div>
					</td>
				</tr>

			</table>
</div>
		
<br /><br />
@include('movies.topmovies',['topmovies'=>$topmovies])
						@endsection