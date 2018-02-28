@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý học sinh' }}
@stop

@section('js_header')
@parent 
{{ HTML::script( asset('custom/js/form-control.js') ) }} 
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

@section('content')
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('StudentController@index') }}" class="btn btn-success">Danh sách học sinh</a>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        {{ Form::open(array('action' => 'StudentController@store', 'class' => 'student-form')) }}
            <div class="box box-primary"> <!-- form start -->
                @include('student.student')
                <div class="box-body col-sm-6">
                    @include('student.family')
                    {{-- @include('student.package') --}}
                </div>
            </div>
            <!-- /.box-body -->
            <div class="clearfix clear"></div>
            <div class="box-footer">
                <input type="submit" class="btn btn-primary" value="Lưu lại"/>
                <input type="reset" class="btn btn-default" value="Nhập lại"/>
            </div>
        {{ Form::close() }}
    </div><!-- /.box -->
</div>
@stop