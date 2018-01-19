@extends('admin.layout.default')

@section('title')
{{ $title='Thêm mới quyền' }}
@stop

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('PermissionGroupController@store'))) }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Tên quyền</label>
                        <div class="row">
                            <div class="col-sm-6">
                               {{ Form::text('name', Form::old(Input::get('name')), array('class' => 'form-control')) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Code</label>
                        <div class="row">
                            <div class="col-sm-6">
                               {{ Form::text('code', null, array('class' => 'form-control')) }}
                            </div>
                        </div>
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
