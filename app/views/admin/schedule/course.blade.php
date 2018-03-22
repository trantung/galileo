@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý khóa học' }}
@stop
@section('content')
    <!-- Bo loc -->
    <div class="margin-bottom">
        @include('admin.schedule.filter_course')
    </div>
    <table class="table table-bordered table-striped table-hove" >
        <tr>
            <th>STT</th>
            <th>Họ và tên HS</th>
            <th>Trung tâm</th>
            <th>Lớp học</th>
            <th>Môn học</th>
            <th>Trình độ</td>
            <th>Gói học</td>
            <th>Số tiền đã đóng</td>
            <th>Tổng số buổi</td>
            <th>Ngày bắt đầu học</td>
            @if(checkPermissionUserByField('role_id', PTCM))
                <th>Thao tác</th>
            @endif
        </tr>   
        @foreach($data as $key => $value)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ Common::getObject($value->students, 'fullname' ) }}</td>
            <td>{{ Common::getObject($value->centers, 'name' ) }}</td>
            <td>{{ Common::getObject($value->classes, 'name' ) }}</td>
            <td>{{ Common::getObject($value->subjects, 'name' ) }}</td>     
            <td>{{ Common::getObject($value->levels, 'name' ) }}</td>
            <td>{{ Common::getObject($value->packages, 'name' ) }}</td>
            <td>{{ $value->money_paid }}</td>
            <td>{{ $value->lesson_total }}</td>
            <td>{{ 'Buổi '.$value->lesson_code.'- Ngày  '.date('d/m/Y', strtotime(Common::getStartDate($value->id)) )}}</td>
            <td>
                @if(checkPermissionUserByField('role_id', PTCM))
                    @include('admin.schedule.course_modal')
                    <button class="btn btn-primary" data-toggle="modal" data-target="#courseModal-{{ $value->id }}">Sửa</button>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
    <div class="row">
        <div class="col-xs-12">
            {{ $data->appends(Request::except('page'))->links() }}
        </div>
    </div>
    
@stop