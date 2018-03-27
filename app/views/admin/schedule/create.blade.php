@extends('admin.layout.default')

@section('js_header')
@parent 
{{ HTML::script( asset('custom/js/form-control.js') ) }} 
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

@section('title')
{{ $title='Tạo mới lịch học' }}
@stop
@section('content')
	<a class="btn btn-primary" style="margin-bottom: 5px;" href="{{ action('ScheduleController@index') }}">Danh sách lịch học</a>	
	<div class="clearfix"></div>
	{{ Form::open(['action' =>['ScheduleController@store'],'method' => 'POST', 'class' => 'col-sm-6 padding0 schedule-create-form']) }}
		@include('student.package')
		<div class="box-footer">
			{{ Form::submit('Lưu lại', ['class' => 'btn btn-primary']) }}
	    </div>
	{{ Form::close() }}
	<div class="clearfix"></div>
@stop
