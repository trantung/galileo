@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý học sinh' }}
@stop
@section('content')
	<!-- Bo loc -->
	<a href="{{ action('ScheduleController@create') }}" class="btn btn-primary " style=" background-color: green">Thêm lịch học mới</a>
	<table class="table table-bordered table-striped table-hove" >
		<tr>
			<th>Ngày</th>
			<th>Giờ</th>
			<th>Tên HS</th>
			<th>Số điện thoại</th>
			<th>Cố vấn học tập</td>
			<th>Lớp</td>
			<th>Trình độ</td>
			<th>STT buổi</td>
			<th width="140px">Action</th>
		</tr>
		@foreach($data as $key => $item)
			@foreach($item as $i => $value)
				<tr>
					@if( $i == 0  )
						<td rowspan="{{ count($item) }}" style="vertical-align: middle;">{{ date('d/m/Y', strtotime($key)) }}</td>
					@endif
					<td>{{ $value->lesson_hour }}</td>
					<td>{{ $value->student_id }}</td>
					<td>{{ $value->student_id }}</td>
					<td>{{ $value->user_id }}</td>
					<td>{{ $value->class_id }}</td>
					<td>{{ $value->level_id }}</td>
					<td>{{ $value->lesson_code }}</td>
					<td>
			           <a href=" {{ action('ScheduleController@edit', $value->id) }} " class="btn btn-primary">Sửa</a>
					   {{ Form::open(array('method'=>'DELETE', 'action' => array('ScheduleController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
			           <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
			           {{ Form::close() }}
					</td>
				</tr>
			@endforeach
		@endforeach
	</table>
	
@stop