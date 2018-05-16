@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý số lượt tải' }}
@stop
@section('content')
    <!-- Bo loc -->
    
    <a href="{{ action('QuantityDownloadController@create') }}" class="btn btn-primary fa fa-plus"> Thêm bản ghi</a>
    <a href="{{ action('QuantityDownloadController@getChangeGV') }}" class="btn btn-info fa fa-exchange" style="margin-left: 10px"> Thay đổi theo GV</a>
    <a href="{{ action('QuantityDownloadController@getChangePTCM') }}" class="btn btn-info fa fa-exchange"> Thay đổi theo PTCM</a>
    <a href="{{ action('QuantityDownloadController@getChangeCVHT') }}" class="btn btn-info fa fa-exchange"> Thay đổi theo CVHT</a>
    <div class="margin-bottom">
        @include('admin.download.filter')
    </div>
    <table class="table table-bordered table-striped table-hove" >
    <div class="margin-bottom">
    </div>
        <tr>
            <th>Đối tượng</th>
            <th>Lớp học</th>
            <th>Môn học</th>
            <th>Trình độ</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Max_account</td>
            <th>Max_document</td>
            <th>Action</th>
        </tr>
        @foreach($data as $key => $value)
        <tr>
            <td>{{ Common::getRoleName($value->role_id) }}</td>
            <td>{{ Common::getObject($value->classes, 'name') }}</td>
            <td>{{ Common::getObject($value->subjects, 'name') }}</td>
            <td>{{ Common::getObject($value->levels, 'name') }}</td>
            <td>{{ $value->start_time }}</td>
            <td>{{ $value->end_time }}</td>
            <td>{{ $value->max_account }}</td>
            <td>{{ $value->max_document }}</td>
            <td>
                <a href="{{ action('QuantityDownloadController@edit', $value->id) }}" class="btn btn-primary inline-block">Sửa</a>
               {{ Form::open(array('method'=>'DELETE', 'action' => array('QuantityDownloadController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
               <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
               {{ Form::close() }}
            </td>
        </tr>
        @endforeach
    </table>
    
@stop
