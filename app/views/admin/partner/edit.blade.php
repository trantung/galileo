@extends('admin.layout.default')

@section('title')
{{ $title='Sửa' }}
@stop

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('ManagerPartnerController@update', $partner->id), 'method' => 'PUT')) }}
                <div class="box-body">
                    <div class="form-group">
                        @if(isset($message))
                        <div class="row">
                            <div class="col-sm-6">
                                <span style="color:red">{{ $message }}</span>
                            </div>
                        </div>
                        @endif
                        <label for="title">Username đối tác</label>
                        <div class="row">
                            <div class="col-sm-6">
                               {{ Form::text('username', $partner->username, array('class' => 'form-control')) }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title">Tên đối tác</label>
                        <div class="row">
                            <div class="col-sm-6">
                               {{ Form::text('name', $partner->name, array('class' => 'form-control')) }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title">Email đối tác</label>
                        <div class="row">
                            <div class="col-sm-6">
                               {{ Form::text('email', $partner->email, array('class' => 'form-control')) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Phone đối tác</label>
                        <div class="row">
                            <div class="col-sm-6">
                               {{ Form::text('phone', $partner->phone, array('class' => 'form-control')) }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title">Address đối tác</label>
                        <div class="row">
                            <div class="col-sm-6">
                               {{ Form::text('address', $partner->address, array('class' => 'form-control')) }}
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

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
