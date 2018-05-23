@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý lịch học' }}
@stop

@section('content')
    @if(checkPermissionUserByField('role_id', GV))
    <a class="btn btn-primary" href="{{ action('ScheduleController@create') }}"><i class="fa fa-plus"></i> Tạo mới lịch học</a>
    @endif
    <!-- Bo loc -->
    <div class="margin-bottom">
        @include('admin.schedule.filter')
    </div>
    <div class="margin-bottom" style="color: red">
        <p>Có tất cả {{ $total }} lượt học</p>
    </div>
    @if( count($data) )
        <table class="table table-bordered table-striped table-hover" >
            <tr>
                <th>Ngày</th>
                <th>Giờ</th>
                <th>Tên HS</th>
                <th>Số điện thoại</th>
                <th>Cố vấn học tập</td>
                <th>Lớp học</td>
                <th>Môn học</td>
                <th>Trình độ</td>
                <th>STT buổi</td>
                @if(checkPermissionUserByField('role_id', PTCM))
                <th>Sửa</td>
                @endif
            </tr>
            @foreach($data as $key => $item)
                @foreach($item as $i => $value)
                    <tr>
                        @if( $i == 0  )
                            <td rowspan="{{ count($item) }}" style="vertical-align: middle;">{{ date('d/m/Y', strtotime($key)) }}</td>
                        @endif
                        <td>{{ $value->lesson_hour }}</td>
                        <td>{{ Common::getObject($value->students, 'fullname') }}</td>
                        <td>{{ Common::getParentPhone($value->student_id) }}</td>
                        <td>{{ Common::getObject($value->users, 'username') }}</td>
                        <td>{{ Common::getObject($value->classes, 'name') }}</td>
                        <td>{{ Common::getObject($value->subjects, 'name') }}</td>
                        <td>{{ Common::getObject($value->levels, 'name') }}</td>
                        <td><a href="{{ action('ScheduleController@documentLink', [Common::getLessonIdByLessonCodeLevel($value->lesson_code, $value->level_id), $value->student_id]) }}" target ="_blank"  class="btn btn-default fa fa-eye" style="width:80%;"> Buổi {{ $value->lesson_code }}</a></td>
                        <td>
                            @include('admin.schedule.modal')
                            @if(checkPermissionUserByField('role_id', PTCM))
                            <button class="btn btn-info" data-toggle="modal" data-target="#myModal-{{ $value->id }}"><li class="fa fa-edit"></li></button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </table>
    @elseif( empty($_GET) )
        <div class="well well-sm alert">Không có lịch học từ nay đến cuối tuần!</div>
    @else
        <div class="well well-sm alert">Không có dữ liệu hiển thị!</div>
    @endif
    <div class="row">
        <div class="col-xs-12">
            {{ $data2->appends(Request::except('page'))->links() }}
        </div>
    </div>
@stop