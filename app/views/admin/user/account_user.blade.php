@extends('admin.layout.default')

@section('title')
{{ $title='Thông tin user' }}
@stop

@section('content')
    <div class="box box-primary clearfix">
        {{ Form::open(array('action' => array('ManagerUserController@update', $data->id), 'method' => 'PUT')) }}
            <div class="box-body col-sm-6">
                <div class="form-group">
                    <label for="title">Họ và tên</label>
                    {{ Form::text('full_name', $data->full_name, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    <label for="title">Tên trung tâm</label>
                    {{ Form::text('center_id', $data->center_id, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    <label for="title">Tên đăng nhập</label>
                    {{ Form::text('username', $data->username, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    <label for="title">Email</label>
                    {{ Form::text('email', $data->email, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    <label for="title">Địa chỉ</label>
                    {{ Form::text('address', $data->address, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    <label for="title">Công việc</label>
                    {{ Form::text('job', $data->job, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    <label for="title">Ngày sinh</label>
                    {{ Form::text('birthday', $data->birthday, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    <label for="title">Số điện thoại</label>
                    {{ Form::text('phone', $data->phone, array('class' => 'form-control')) }}
                </div>
                <div class="box-footer">
                    {{ Form::submit('Lưu lại', array('class' => 'btn btn-primary')) }}
                </div>
            </div>
        {{ Form::close() }}
    </div>
@stop
