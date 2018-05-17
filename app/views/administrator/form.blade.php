@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý admin' }}
@stop
@section('content')
<?php
if( !isset($admin) ){
    $admin = null;
}
?>
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('AdminController@index') }}" class="btn btn-success">Danh sách Admin</a>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            @if( Common::getObject($admin, 'id') )
                {{ Form::open(array('action' => array('AdminController@update',$admin->id), 'method' => "PUT")) }}
            @else
                {{ Form::open(array('action' => 'AdminController@store')) }}
            @endif
            <div class="box-body">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        {{  Form::text('username', Common::getObject($admin, 'username'), array('class' => 'form-control', 'required' => 'required' )) }}
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        {{  Form::text('email', Common::getObject($admin, 'email'), array('class' => 'form-control', 'required' => 'required' )) }}
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" {{ (Common::getObject($admin, 'id') == null) ? 'required' : '' }} id="password" pattern="[0-9a-fA-F]{4,12}" placeholder="Password" name="password">
                    </div>
                    
                    <div class="form-group">
                        <label for="role_id">Phân quyền</label>
                        {{  Form::select('role_id', getRoleAdmin(), Common::getObject($admin, 'role_id'), array('class' => 'form-control', 'required' => 'required' )) }}
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <input type="submit" class="btn btn-primary" value="Lưu lại" />
                <input type="reset" class="btn btn-default" value="Nhập lại" />
            </div>
            {{ Form::close() }}
        </div>
        <!-- /.box -->
    </div>
</div>

@stop
