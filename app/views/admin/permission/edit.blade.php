@extends('admin.layout.default')

@section('title')
{{ $title='Phân quyền' }}
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
        <div class="box-body">
          <label>Biên tập viên {{ $admin->username }}</label>
        </div>
        <!-- form start -->
        {{ Form::open(array('action' => array('PermissionController@update', $admin->id), 'method' => 'PUT')) }}
          <div class="box-body">
            @foreach(Subject::lists('name', 'id') as $subjectId => $subjectName)
                <div class="form-group">
                  <label>{{ $subjectName }}</label>
                    @foreach(PermissionGroup::lists('name', 'id') as $groupId => $groupName)
                    <div class="row">
                        <div class="col-sm-6">
                           {{ Form::checkbox('permission['.$subjectId.']['.$groupId.']', null, checkActiveUserPerCheckbox('Admin', $admin->id, $groupId, $subjectId)) }} {{ $groupName }}
                        </div>
                    </div>
                    @endforeach
                </div>
            @endforeach
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
