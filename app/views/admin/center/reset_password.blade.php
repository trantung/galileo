@extends('admin.layout.default')

@section('title')
{{ $title='Reset mật khẩu đối tác' }}
@stop

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('ManagerPartnerController@postResetPass', $id))) }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Mật khẩu mới</label>
                        <div class="row">
                            <div class="col-sm-6">
                               {{ Form::password('password', null, array('class' => 'form-control')) }}
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
@include('admin.common.ckeditor')
@stop
