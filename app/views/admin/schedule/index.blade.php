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
		</tr>
		@foreach($data as $key => $item)
			@foreach($item as $i => $value)
				<tr>
					@if( $i == 0  )
						<td rowspan="{{ count($item) }}" style="vertical-align: middle;">{{ date('d/m/Y', strtotime($key)) }}</td>
					@endif
					<td>{{ $value->lesson_hour }}</td>
					<td>{{ $value->students->fullname  }}</td>
					<td>{{ Common::getParentPhone($value->student_id) }}</td>
					<td>{{ $value->users->username}}</td>
					<td>{{ $value->classes->name}}</td>
					<td>{{ $value->levels->code }}</td>
					<td>{{ $value->lesson_code }}</td>
				</tr>
			@endforeach
		@endforeach
	</table>
	<div class="row">
	    <div class="col-xs-12">
	        {{ $data2->appends(Request::except('page'))->links() }}
	    </div>
	</div>
@stop