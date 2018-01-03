@extends('admin.layout.default')

@section('title')
{{ $title='Thêm mới trung tâm' }}
@stop

@section('content')
@include('admin.js.form')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- form start -->
            {{ Form::open(array('action' => array('ManagerCenterController@store'))) }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Tên trung tâm</label>
                        <div class="row">
                            <div class="col-sm-6">
                               {{ Form::text('name', null, array('class' => 'form-control')) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="partner">
                        <label for="name">Đối tác</label>
                        <div class="row">
                            <div class="col-sm-6">
                               {{  Form::select('partner_id', ['' => 'Chọn'] + $listPartners, null, array('class' => 'form-control' )) }}
                            </div>
                        </div>
                    </div>
                    <div id="partner_form">
                        
                    </div>
                    <div class="form-group">
                        <label for="title">Phone</label>
                        <div class="row">
                            <div class="col-sm-6">
                               {{ Form::text('phone', null, array('class' => 'form-control')) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Địa chỉ trung tâm</label>
                        <div class="row">
                            <div class="col-sm-6">
                               {{ Form::text('address', null, array('class' => 'form-control')) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Mã code trung tâm</label>
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
<script type="text/javascript">
    $('#partner').on('change', function(){
        $('#partner_form').append($('#test').html());
    });
</script>
@stop
