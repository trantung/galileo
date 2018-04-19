
@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý lịch sử tải' }}
@stop
@section('content')

<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Danh sách lịch sử tải</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>Người dùng</th>
              <th>Đối tượng</th>
              <th>Chương trình</th>
              <th>Mã tài liệu</th>
              <th>Trạng thái</th>
              <th>Phê duyệt</th>
              <th>Xóa</th>
            </tr>
            @foreach($data as $key => $value)
            <tr>
                <td>{{ Common::getObject($value->users, 'username') }}</td>
                <td>{{ $value->model_name }}</td>
                <td>{{ Common::getObject($value->levels, 'name') }}</td>
                <td>{{ $value->document_code }}</td>
                <td>{{ $value->status }}</td>
                <td>
                    @if($value->status == 2)
                        <a href=" {{ action('AskPermissionController@show', $value->document_id) }} " class="btn btn-primary">Chưa phê duyệt</a>
                    @else  
                        <p class="btn btn-success">Đã Phê duyệt</p>
                    @endif
                </td>
                <td>
                    {{ Form::open(array('method'=>'DELETE', 'action' => array('AskPermissionController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
                        <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>

@stop
