@extends('admin.layout.default')
@section('title')
{{ $title='Quản lý số lượt download' }}
@stop

@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

@section('content')
{{ Form::open(array('action' => 'QuantityDownloadController@store', 'class' => 'student-form')) }}
<div class="box-body col-sm-6">
    <div class="form-group well well-sm">
        
        <div class="box alert filter-document-form">
            <div class="input-group inline-block">
            <label style="display: block;">Chọn lớp học</label>
            {{ Form::select('class_id', ['' => '--Tất cả--'] + Common::getClassList(), Input::get('class_id'), ['class' => 'form-control select-class', 'required' => true]) }}
            </div>

            <div class="input-group inline-block">
            <label style="display: block;">Chọn môn học</label>
            {{ Form::select('subject_id', ['' => '--Tất cả--'] + Common::getSubjectList(), Input::get('subject_id'), ['class' => 'form-control select-subject', 'required' => true]) }}
            </div>

            <div class="input-group inline-block select-level-from-class-subject">
                <label style="display: block;">Chọn trình độ</label>
                 {{ Common::getLevelDropdownList('level_id', Input::get('level_id')) }}
            </div>
        
        </div>

        <div class="input-group inline-block col-sm-8">
            <label>Chọn đối tượng</label>
            {{ Form::select('role_id', ['' => '-- chọn --', 2 => 'Giáo vụ', 3 => 'Phụ trách chuyên môn', 4 => 'Cố vấn học tập'], Input::get('role_id'),['class' => 'form-control', 'data-live-search' => 'true'])}}
        </div>

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