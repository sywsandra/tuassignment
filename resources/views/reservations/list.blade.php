@extends('../template')
<h1>Select Seat</h1>
<div class="cinemaHall">
    <?php if(isset($error)): ?>
        <p style="color:red;">Please select seat(s).</p>
    <?php endif; ?>
    <form id="reservation" method="post" action="{{ action('ReservationController@create') }}">
   
     <section id="seats">
     <table>
     <tr><td colspan="12" align="middle"><div class="screen"></div></td>
     <td  align="right"><button type="submit" class="btn btn-default">Select</button></td>
     </tr>
    	<?php 
    	foreach($rows as $row) {
    	    ?>
    	    <tr>
    	    <td class="seatrow"> <label>{{$row}}</label></td>
    	    
    	    <?php for($i = 1; $i <= 12; $i++) {
                $finded = false;
                foreach($occupedSeats as $occupedSeat) {
                    if($row.$i == $occupedSeat) {
                        $finded = true; 
                        break;
                    }
                } ?>
              <td class="seatrow">  <input id="seat-{{$row}}{{$i}}" class="seat-select" <?php if($finded) echo 'disabled'; ?> type="checkbox" value="{{$row}}{{$i}}" name="seat[]" />
                <label for="seat-{{$row}}{{$i}}" class="seat <?php if($finded) echo 'occuped'; ?>">{{$i}}</label>
       		</td>
            <?php } ?>
    	    
    	    </tr>
    	<?php } ?>
    	<tr>
    	<td colspan="13" align="right">
    	 <button type="submit" class="btn btn-default">Select</button>
    	</td>
    	</tr>
    	</table>
        </section>
        <input type="hidden" name="movie" value="{{ $movie_id }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
   
    </form>
</div>