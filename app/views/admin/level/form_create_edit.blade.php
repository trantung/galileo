@extends('admin.layout.default')
@section('title')
    {{ $title = ($data == null) ? 'Thêm mới trình độ' : 'Sửa trình độ' }}
@stop
@section('content')

<a href="{{ action('LevelController@index') }}" class="btn btn-primary"><i class = "fa fa-list-ul"></i> Danh sách trình độ</a>
<hr>
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <!-- form start -->
            @if(isset($data->id) && !empty($data->id))
                {{ Form::open(['action' => ['LevelController@update', $data->id], 'method' => "PUT" ]) }}
            @elseif(!isset($data->id))
                {{ Form::open(['action' => ['LevelController@store'], 'method' => "POST" ]) }}
            @endif
                <div class="box-body">
                    <div class="col-sm-6">
                        <div class="form-group">
                          {{ Form::label('name', 'Tên trình độ') }}
                          {{ Form::text('name', \Common::getObject($data, 'name'), ['placeholder' => 'tên trình độ', 'class' => 'form-control', 'required' => true] ) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('code', 'Mã trình độ') }}
                          {{ Form::text('code', \Common::getObject($data, 'code'), ['placeholder' => 'mã trình độ', 'class' => 'form-control', 'required' => true] + (!empty($data->id) ? ['disabled' => true] : []) ) }}
                        </div>

                        <div class="input-group inline-block">
                            <label style="display: block;">Lớp học</label>
                            {{ Form::select('class_id', ['' => '--Tất cả--'] + Common::getClassList(), \Common::getObject($data, 'class_id'), ['class' => 'form-control select-class', 'required' => true] + (!empty($data->id) ? ['disabled' => true] : []) ) }}
                        </div>
                        <div class="form-group input-group inline-block">
                            <label style="display: block;">Môn học</label>
                            {{ Form::select('subject_id', ['' => '--Tất cả--'] + Common::getSubjectList(), \Common::getObject($data, 'subject_id'), ['class' => 'form-control select-subject', 'required' => true] + (!empty($data->id) ? ['disabled' => true] : []) ) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('number_lesson', 'Số buổi') }}
                          {{ Form::number('number_lesson', \Common::getObject($data, 'number_lesson'), array('placeholder' => 'số buổi', 'class' => 'form-control', 'required' => true, 'max' => 100, 'min' => 1)) }}
                        </div>

                        <div class="box-footer">
                          <input type="submit" class="btn btn-primary" value="Lưu lại" />
                          <input type="reset" class="btn btn-default" value="Nhập lại" />
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop
