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
            <th>Bắt đầu học từ buổi</td>
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
            <td>{{ Common::getStartDate($value->id) }}</td>
            <td>{{ $value->lesson_total }}</td>
            <td>{{ $value->lesson_code }}</td>
        </tr>
        @endforeach
    </table>
    
@stop