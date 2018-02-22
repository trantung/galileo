@extends('admin.layout.default')

@section('title')
{{ $title='' }}
@stop
@section('content')

<a href="{{ action('PackageController@index') }}" class="btn btn-success">Danh sách  gói học</a>

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
        <!-- form start -->      
          {{ Form::open(['action' => ['PackageController@update', $package->id], 'method' => "PUT" ]) }}
          <div class="box-body">            
            <div class="form-group">
              {{ Form::label('name', 'Tên gói') }}
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::text('name', $package->name, ['class' => 'form-control', 'required' => true]) }}
                </div>
              </div>
            </div>

            <div class="form-group">
              {{ Form::label('lesson_per_week', 'Số buổi học trong tuần') }}
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::number('lesson_per_week', $package->lesson_per_week, [ 'class' => 'form-control', 'required' => true]) }}
                </div>
              </div>
            </div>

            <div class="form-group">
              {{ Form::label('total_lesson', 'Tổng số buổi') }}
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::number('total_lesson', $package->total_lesson, ['class' => 'form-control', 'required' => true]) }}
                </div>
              </div>
            </div>

            <div class="form-group">
              {{ Form::label('price', 'Giá tiền mỗi buổi') }}       
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::number('price', $package->price, [ 'class' => 'form-control', 'required' => true]) }}                  
                </div>
              </div>
            </div>

            <div class="form-group">
              {{ Form::label('duration', "Thời gian học mỗi buổi") }}    
              <div class="row">
                <div class="col-sm-6">                  
                 {{ Form::number('duration', $package->duration, [ 'class' => 'form-control', 'required' => true]) }}
                </div>
              </div>
            </div>

            <div class="form-group">
              {{ Form::label('max_student', 'Học sinh học') }}       
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('max_student', [ '1' => '1' , '2' => '2', '3' => '3'], $package->max_student,  ['class' => 'form-control']) }}
                </div>
              </div>
            </div>
	

		  <div class="box-footer">
            <input type="submit" class="btn btn-primary" value="Lưu lại" />
            <input type="reset" class="btn btn-default" value="Nhập lại" />
          </div>

	{{ Form::close() }}
@stop
