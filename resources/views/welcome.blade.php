@extends('layouts.master')

@section('content')

<div class="col-md-6">

<form action="search">

    <h3>Search</h3>

    Location
    <p><input type="text" id="" name="location" class="form-control" value=""></p>

    From
    <p><input type="text" id="datetimepicker_from" name="from_date" class="form-control" value=""></p>
    To
    <p><input type="text" id="datetimepicker_to" name="to_date" class="form-control" value=""></p>
    <br/>

    <input class="btn btn-primary" type="submit" value="Search"/>

</form>

<hr />

<form action="checkReservation">

    <h3>Reservation Check</h3>
    <p><input type="text" id="datetimepicker_from" name="reservation_no" class="form-control" value=""></p>

    <input class="btn btn-primary" type="submit" value="Search"/>

</form>

</div>

<script src="{{asset('js/jquery.datetimepicker.full.min.js')}}"></script>
<link href="{{asset('css/jquery.datetimepicker.css')}}" rel="stylesheet">
<script>

$('#datetimepicker_from').datepicker({ dateFormat: 'yy-mm-dd' }).val();
$('#datetimepicker_to').datepicker({ dateFormat: 'yy-mm-dd' }).val();

$('#datetimepicker').datetimepicker({
format:'Y-m-d H:i',

}).on('changeDate', function(e){
$(this).datetimepicker('hide');
});


$('#datetimepicker2').datetimepicker({
format:'Y-m-d H:i',

});


</script>

@stop
