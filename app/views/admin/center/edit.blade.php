@extends('admin.layout.default')

@section('title')
{{ $title='Sửa' }}
@stop

@section('content')
    <div class="box box-primary clearfix">
        {{ Form::open(array('action' => array('ManagerCenterController@update', $center->id), 'method' => 'PUT')) }}
            <div class="box-body col-sm-6">
                <div class="form-group">
                    <label for="title">Tên trung tâm</label>
                    {{ Form::text('name', $center->name, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    <label for="name">Đối tác</label>
                    @if( count($listPartners) )
                        {{  Form::select('partner_id', ['' => 'Chọn'] + $listPartners, null, array('class' => 'form-control' )) }}
                    @else
                        <br><a href="{{ action('ManagerPartnerController@create') }}">Thêm đối tác</a>
                    @endif
                </div>
                <div class="form-group hidden">
                    <label>Chọn lớp</label>
                    @include('admin.js.get_level_center_form', ['listClasses' => $listClasses, 'listLevels'=>$listLevels])
                </div>
                <div class="form-group">
                    <label for="title">Phone</label>
                    {{ Form::text('phone', $center->phone, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    <label for="title">Địa chỉ trung tâm</label>
                    {{ Form::text('address', $center->address, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    <label for="title">Mã code trung tâm</label>
                    {{ Form::text('code', $center->code, array('class' => 'form-control')) }}
                </div>
                <div class="box-footer">
                    {{ Form::submit('Lưu lại', array('class' => 'btn btn-primary')) }}
                </div>
            </div>
        {{ Form::close() }}
    </div>
@stop
