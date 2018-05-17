@extends('admin.layout.default')

@section('title')
	{{ $title='Upload File' }}
@stop

@section('js_header')
@parent 
{{ HTML::script( asset('custom/js/form-control.js') ) }} 
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

@section('content')

	{{ Form::open(array('action' => array('AdminController@postUploadFile'), 'files' => true)) }}
	<div class="col-sm-4">
	    {{ Form::file('document[]', array('multiple'=>true, 'class' => 'form-control btn', 'accept' => '.pdf' )) }}
	  	{{-- <span>{{ $error }}</span> --}}
	    <span class="text-danger"> <b>Chú ý :</b> Upload tối đa 100 file</span>
	</div>
	{{ Form::submit(' Load', ['class' => 'btn btn-primary']) }}
	{{ Form::close() }}	
@stop