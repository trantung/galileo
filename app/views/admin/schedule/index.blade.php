@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý học sinh' }}
<a class="btn btn-primary" href="{{ action('ScheduleController@create') }}"><i class="fa fa-plus"></i> Tạo mới lịch học</a>
@stop

@section('content')
	<!-- Bo loc -->

	<div class="margin-bottom">
	    @include('admin.schedule.filter')
	</div>
	<table class="table table-bordered table-striped table-hove" >
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
		</tr>
		@foreach($data as $key => $item)
			@foreach($item as $i => $value)
				<tr>
					@if( $i == 0  )
						<td rowspan="{{ count($item) }}" style="vertical-align: middle;">{{ date('d/m/Y', strtotime($key)) }}</td>
					@endif
					<td>{{ $value->lesson_hour }}</td>
					<td>{{ $value->students->fullname }}</td>
					<td>{{ Common::getParentPhone($value->student_id) }}</td>
					<td>{{ $value->users->username }}</td>
					<td>{{ $value->classes->name }}</td>
					<td>{{ $value->subjects->name }}</td>
					<td>{{ $value->levels->name }}</td>
					<td>{{ $value->lesson_code }}</td>
				</tr>
			@endforeach
		@endforeach
	</table>
	
@stop