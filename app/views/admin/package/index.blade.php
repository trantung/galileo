@extends('admin.layout.default')

@section('title')
{{ $title='quản lý package' }}
@stop
@section('content')	

	<a href="{{ action('PackageController@create') }}" class="btn btn-primary " style=" background-color: green">Thêm học gói học mói </a>
	<table class ="table table-bordered table-striped table-hover">
		<tr>
			<th>Tên gói</th>
			<th>Số buổi học trong tuần</th>
			<th>Tổng số buổi</th>
			<th>Thời gian mỗi buổi học</th>
			<th>Giá tiền một buổi học</th>						
			<th>Học sinh học</th>		
			<th> Sửa</th>
			<th> Xóa</th>
		</tr>
		@foreach($data as $key => $value)
		<tr>
			<td>{{ $value->name}}</td>
			<td>{{ $value->lesson_per_week }}</td>
			<td>{{ $value->total_lesson }}</td>
			<td>{{ $value->duration }}</td>
			<td>{{ $value->price }}</td>			
			<td>{{ $value->max_student }}</td>
			<td><a href="{{ action('PackageController@edit', $value->id) }}" class="btn btn-primary">Sửa</a></td>
			<td>
			   {{ Form::open(['action' => ['PackageController@destroy', $value->id], 'method' => 'DELETE','style' => 'display: inline-block;']) }}
	           <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
	           {{ Form::close() }}
			</td>
		
		</tr>
		@endforeach
	</table>





















@stop