@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý admin' }}
@stop
@section('content')

<div class="row margin-bottom">
    <div class="col-xs-12">
        {{ renderUrl('RoleController@index', 'Quản lý nhóm quyền', [], ['class' => 'btn btn-primary']) }}
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('RoleController@update', $data->id), 'method' => "PUT")) }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="role_id">Tên nhóm quyền</label>
                        <div class="row">
                            <div class="col-sm-6">
                                {{ Form::text('name', $data->name, ['class' => 'form-control']) }}
                                <i>({{ $data->slug }})</i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <input type="submit" class="btn btn-primary" value="Lưu lại" />
                </div>
            {{ Form::close() }}
        </div>
        <!-- /.box -->
    </div>
</div>

@stop
