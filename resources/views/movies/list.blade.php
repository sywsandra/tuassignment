@extends('layouts.frontend')
@section('content')
<script>
$(document).ready(function(){    $('.dataTable').DataTable();});
</script>
<div class="section_1">
<div class="page-header" >
<h1>Movie</h1>
</p></div>
    @if ($movies->isEmpty())
No record found.
    @else
<table class="dataTable">
<thead>
<tr>
<th>Title</th>
<th>Desc</th>
<th>Book</th>
</tr>
</thead>
<tbody>
                @foreach($movies as $movie)
    <tr>
<td>{{ $movie->name }}</td>
<td>{{ $movie->desc }}</td>

<td>
    <a href="{{ action('ReservationController@index', $movie->id) }}" class="btn btn-default">Book</a>
</td>
    </tr>
                @endforeach
            </tbody>
</table>
    @endif
    
    </div>
@stop
