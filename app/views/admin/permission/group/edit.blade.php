@extends('admin.layout.default')

@section('title')
{{ $title='Sửa' }}
@stop

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('PermissionGroupController@update', $group->id), 'method' => 'PUT')) }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Tên quyền</label>
                        <div class="row">
                            <div class="col-sm-6">
                               {{ Form::text('name', $group->name, array('class' => 'form-control')) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Code</label>
                        <div class="row">
                            <div class="col-sm-6">
                               {{ Form::text('code', $group->code, array('class' => 'form-control')) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Danh sách các quyền</label>
                        @foreach(getMethodDefault('DocumentController') as $key => $value)
                        <div class="row">
                            <div class="col-sm-6">
                               {{ Form::checkbox('permission['.$value.']['.$key.']', null, checkActiveCheckbox($value, $key, $group->id)) }} {{ $key }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="box-footer">
                        {{ Form::submit('Lưu lại', array('class' => 'btn btn-primary')) }}
                    </div>
                </div>
            {{ Form::close() }}
            <!-- /.box -->
        </div>
    </div>
</div>
@stop
