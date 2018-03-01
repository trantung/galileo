@extends('admin.layout.default')

@section('title')
{{ $title='Thêm mới trung tâm' }}
@stop

@section('content')
@include('admin.js.form')
    <div class="box box-primary clearfix">
        <!-- form start -->
        {{ Form::open(array('action' => array('ManagerCenterController@store'))) }}
            <div class="box-body col-sm-6">
                <div class="form-group">
                    <label for="title">Tên trung tâm</label>
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>
                <div class="form-group" id="partner">
                    <label for="name">Đối tác</label>
                    @if( count($listPartners) )
                        {{  Form::select('partner_id', ['' => 'Chọn'] + $listPartners, null, array('class' => 'form-control' )) }}
                    @else
                        <br><a href="{{ action('ManagerPartnerController@create') }}">Thêm đối tác</a>
                    @endif
                </div>
                <div class="form-group hidden">
                    <label>Chọn lớp</label>
                    @include('admin.js.get_level_center_form', ['listClasses' => $listClasses, 'listLevels' => $listLevels])
                </div>
                <div class="form-group">
                    <label for="title">Phone</label>
                    {{ Form::text('phone', null, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    <label for="title">Địa chỉ trung tâm</label>
                    {{ Form::text('address', null, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    <label for="title">Mã code trung tâm</label>
                    {{ Form::text('code', null, array('class' => 'form-control')) }}
                </div>
                <div class="box-footer">
                    {{ Form::submit('Lưu lại', array('class' => 'btn btn-primary')) }}
                </div>
            </div>
        {{ Form::close() }}
        <!-- /.box -->
    </div>
@stop
