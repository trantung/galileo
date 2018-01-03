@extends('admin.layout.default')

@section('css_header')
@parent
{{--  --}}
@stop

@section('js_header')
@parent
{{--  --}}
@stop

@section('title')
Tạo mới môn học
@stop

@section('content')
	{{ Form::open(['action' => ['SubjectController@store'], 'method' => 'POST', 'class' => 'col-sm-6']) }}
		<div class="form-group">
			{{ Form::label('subject_name', 'Tên môn học') }}
			{{ Form::text('subject_name', '', ['class' => 'form-control', 'required' =>'']) }}
		</div>
		<div class="form-group">
			{{ Form::submit('Lưu', ['class'=>'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
@stop