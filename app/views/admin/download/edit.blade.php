@extends('admin.layout.default')
@section('title')
{{ $title='Chỉnh sửa bản ghi' }}
@stop

@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

@section('content')
{{ Form::open(['action' =>['QuantityDownloadController@update', $quantity->id], 'method' => "PUT" ,'class' => 'student-form']) }}
<div class="box-body col-sm-6">
    <div class="form-group well well-sm">
        <div class="box alert filter-document-form">
            <div class="input-group inline-block">
                
                <label style="display: block;">Chọn lớp học</label>
                {{ Form::select('class_id', ['' => '--Tất cả--'] + Common::getClassList(), $quantity->class_id, ['class' => 'form-control select-class', 'required' => true]) }}
            </div>
            <div class="input-group inline-block">
                <label style="display: block;">Chọn môn học</label>
                {{ Form::select('subject_id', ['' => '--Tất cả--'] + Common::getSubjectList(), $quantity->subject_id, ['class' => 'form-control select-subject', 'required' => true]) }}
            </div>

            <div class="input-group inline-block select-level-from-class-subject">
                <label style="display: block;">Chọn trình độ</label>
                 {{ Common::getLevelDropdownList('level_id', $quantity->subject_id) }}
            </div>
        
        </div>
        <div class="input-group inline-block col-sm-8">
            <label>Chọn đối tượng</label>
            {{ Form::select('role_id', ['' => '-- chọn --', 2 => 'Giáo vụ', 3 => 'Phụ trách chuyên môn', 4 => 'Cố vấn học tập'], $quantity->role_id,['class' => 'form-control', 'data-live-search' => 'true'])}}
        </div>
        <div class="input-group inline-block col-sm-8">
            <label for="max_account">Số lượt tải/tài khoản</label>
            {{ Form::text('max_account', $quantity->max_account, array('class' => 'form-control')) }}
        </div>
        <div class="input-group inline-block col-sm-8">
            <label for="max_document">Số lượt tải/tài liệu</label>
            {{ Form::text('max_document', $quantity->max_document, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            <label for="start_time">Ngày bắt đầu</label>
            <input type="date" class="form-control" id="start_time" value="{{ date('Y-m-d', strtotime($quantity->start_time)) }}" name="start_time">
        </div>
        <div class="form-group">
            <label for="end_time">Ngày kết thúc</label>
            <input type="date" class="form-control" id="end_time" value="{{ date('Y-m-d', strtotime($quantity->end_time)) }}" name="end_time">
        </div>
        <div class="form-group">    
            <input type="submit" class="btn btn-primary" value="Lưu lại"/>
            <input type="reset" class="btn btn-default" value="Nhập lại"/>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop