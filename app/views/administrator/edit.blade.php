@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý admin' }}
@stop
@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('AdminController@index') }}" class="btn btn-success">Danh sách Admin</a>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
        <!-- form start -->
        {{ Form::open(array('action' => array('AdminController@update', $admin->id), 'method' => "PUT")) }}
          <div class="box-body">

            <div class="form-group">
              <label for="role_id">Role id</label>
              <div class="row">
                <div class="col-sm-6">
                  {{  Form::select('role_id', getRoleAdmin(), $admin->role_id, array('class' => 'form-control', 'required' => 'required' )) }}
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <div class="row">
                <div class="col-sm-6">
                  {{  Form::text('email', $admin->email, array('class' => 'form-control', 'required' => 'required' )) }}
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="password" class="form-control" required id="password" pattern="[0-9a-fA-F]{4,12}" placeholder="Password" name="password">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="username">Username</label>
              <div class="row">
                <div class="col-sm-6">
                  {{  Form::text('username', $admin->username, array('class' => 'form-control', 'required' => 'required' )) }}
                </div>
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
