@extends('layouts.master')

@section('content')

<hr>

{!! Form::open([
    'method' => 'post',
    'url' => 'reservation/confirmReservation'
]) !!}

<h2>Reservation Detail </h2>
<h3>{{ $facility->place->name }}</h3>
<p>
  {{ $facility->name }}
</p>


<input type="hidden" name="facility_id" value="{{ $facility->id}}" />
From
<p><input type="text" id="datetimepicker_from" name="from_date" class="form-control" value="{{$from_date}}"></p>
To
<p><input type="text" id="datetimepicker_to" name="to_date" class="form-control" value="{{$to_date}}"></p>
<br/>

{!! Form::submit('Confirm Reservation', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

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
