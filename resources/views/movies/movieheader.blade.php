
    <title>Movie</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" />
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

<nav class="navbar navbar-inverse">
<div class="navbar-header">
<a class="navbar-brand" href="{{ URL::to('movielist') }}">All Movies >> </a>
</div>
<ul class="nav navbar-nav">
<li><a href="{{ URL::to('movielist') }}">View All movies</a></li>
	<li><a href="{{ route('movies.create') }}">Add a movie</a></li>
</ul>
</nav>
