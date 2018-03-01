@extends('admin.layout.default')

@section('title')
{{ $title='quản lý package' }}
@stop
@section('content')


    <a href="{{ action('PackageController@index') }}" class="btn btn-success">Danh sách  gói học</a>
 

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
        <!-- form start -->
          {{ Form::open(['action' => ['PackageController@store'], 'method' => "POST" ]) }}
          <div class="box-body">

            <div class="form-group">
              {{ Form::label('name', 'Tên gói') }}
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::text('name', null, array('placeholder' => 'tên gói', 'class' => 'form-control', 'required' => true)) }}
                </div>
              </div>
            </div>

            <div class="form-group">
              {{ Form::label('lesson_per_week', 'Số buổi học trong tuần') }}
              <div class="row">
                <div class="col-sm-6">
                 {{ Form::number('lesson_per_week', null, array('placeholder' => 'tsb', 'class' => 'form-control', 'required' => true)) }}
                </div>
              </div>
            </div>

            <div class="form-group">
              {{ Form::label('total_lesson', 'Tổng số buổi') }}
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::number('total_lesson', null, array('placeholder' => 'tongsb', 'class' => 'form-control', 'required' => true)) }}
                </div>
              </div>
            </div>

            <div class="form-group">
              {{ Form::label('price', 'Giá tiền mỗi buổi') }}       
              <div class="row">
                <div class="col-sm-6">
                 {{ Form::number('price', null, array('placeholder' => 'giá tiền', 'class' => 'form-control', 'required' => true)) }}                        
                </div>
              </div>
            </div>

            <div class="form-group">
              {{ Form::label('duration', "Thời gian học mỗi buổi") }}       
              <div class="row">
                <div class="col-sm-6">
                 {{ Form::number('duration', null, array('placeholder' => 'thời gian học', 'class' => 'form-control', 'required' => true)) }}
                </div>
              </div>
            </div>

            <div class="form-group">
              {{ Form::label('max_student', 'Học sinh học') }}       
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('max_student',[ '1' => '1' , '2' => '2', '3' => '3'],null,  ['class' => 'form-control']) }}
                </div>
              </div>
            </div>
            
            
	

		  <div class="box-footer">
            <input type="submit" class="btn btn-primary" value="Lưu lại" />
            <input type="reset" class="btn btn-default" value="Nhập lại" />
          </div>
	{{ Form::close() }}
@stop
