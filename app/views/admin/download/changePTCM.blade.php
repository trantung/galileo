@extends('admin.layout.default')
@section('title')
{{ $title='Quản lý số lượt tải của phụ trách chuyên môn' }}
@stop

@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

@section('content')
<a href="{{ action('QuantityDownloadController@index') }}" class="btn btn-primary glyphicon glyphicon-arrow-left "></a>
{{ Form::open(array('action' => 'QuantityDownloadController@postChangePTCM', 'class' => 'student-form')) }}
<div class="box-body col-sm-6">
    <div class="form-group well well-sm">

        <div class="input-group inline-block col-sm-8">
            <label for="max_account">Số lượt tải/tài khoản</label>
            {{ Form::text('max_account', Input::get('max_account'), array('class' => 'form-control', 'placeholder' => 'Số lượt tải tối đa trên 1 tài khoản' )) }}
        </div>
        <div class="input-group inline-block col-sm-8">
            <label for="max_document">Số lượt tải/tài liệu</label>
            {{ Form::text('max_document', Input::get('max_document'), array('class' => 'form-control', 'placeholder' => 'Số lượt tải tối đa trên 1 tài liệu' )) }}
        </div>
        <div class="input-group inline-block col-sm-4" >
            <label>Chọn ngày bắt đầu</label>
            <input type="date" class="lesson_date form-control" required placeholder="Ngày bắt đầu" name="start_time">
        </div>
        <div class="input-group inline-block col-sm-4" >
            <label>Chọn ngày kết thúc</label>
            <input type="date" class="lesson_date form-control" required placeholder="Ngày kết thúc" name="end_time">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Lưu lại"/>
            <input type="reset" class="btn btn-default" value="Nhập lại"/>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop