@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý số lượt tải' }}
@stop
@section('content')
    <!-- Bo loc -->
    
    <a href="{{ action('QuantityDownloadController@create') }}" class="btn btn-primary">Thêm tùy chỉnh</a>
   
    <div class="margin-bottom">
        @include('admin.download.filter')
    </div>
    <table class="table table-bordered table-striped table-hove" >
    <div class="margin-bottom">
    </div>
        <tr>
            
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
            <td>{{ $value->classes->name }}</td>
            <td>{{ $value->subjects->name }}</td>
            <td>{{ $value->levels->name }}</td>
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
