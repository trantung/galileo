@extends('admin.layout.default')
@section('title')
{{ $title='Sửa' }}
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            {{ Form::open(array('action' => array('ManagerCenterController@update', $center->id), 'method' => 'PUT')) }}
            <div class="box-body">
                <div class="form-group">
                    <label for="title">Tên trung tâm</label>
                    <div class="row">
                        <div class="col-sm-6">
                           {{ Form::text('name', $center->name, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Đối tác</label>
                    <div class="row">
                        <div class="col-sm-6">
                           {{  Form::select('partner_id', ['' => 'Chọn'] + $listPartners, $partnerId, array('class' => 'form-control' )) }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Chọn lớp</label>
                    @include('admin.js.get_level_center_form', ['listClasses' => $listClasses, 'listLevels'=>$listLevels])
                </div>
                <div class="form-group">
                    <label for="title">Phone</label>
                    <div class="row">
                        <div class="col-sm-6">
                           {{ Form::text('phone', $center->phone, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">Địa chỉ trung tâm</label>
                    <div class="row">
                        <div class="col-sm-6">
                           {{ Form::text('address', $center->address, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">Mã code trung tâm</label>
                    <div class="row">
                        <div class="col-sm-6">
                           {{ Form::text('code', $center->code, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {{ Form::submit('Lưu lại', array('class' => 'btn btn-primary')) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop
