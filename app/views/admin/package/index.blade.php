@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý gói học' }}
@stop
@section('content')	

	<a href="{{ action('PackageController@create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm gói học mới</a>
	<table class ="table table-bordered table-striped table-hover">
		<tr>
			<th>Tên gói</th>
			<th>Số buổi học trong tuần</th>
			<th>Tổng số buổi</th>
			<th>Thời gian mỗi buổi học</th>
			<th>Giá tiền một buổi học</th>						
			<th>Số học sinh học</th>		
			<th width="180px"> Action</th>
		</tr>
		@foreach($data as $key => $value)
		<tr>
			<td>{{ $value->name}}</td>
			<td>{{ $value->lesson_per_week }}</td>
			<td>{{ $value->total_lesson }}</td>
			<td>{{ $value->duration }}</td>
			<td>{{ $value->price }}</td>			
			<td>{{ $value->max_student }}</td>
			<td><a href="{{ action('PackageController@edit', $value->id) }}" class="btn btn-primary fa fa-edit"> Sửa</a>
			
			   {{ Form::open(['action' => ['PackageController@destroy', $value->id], 'method' => 'DELETE','style' => 'display: inline-block;']) }}
	           <button class="btn btn-danger fa fa-trash" onclick="return confirm('Bạn có chắc chắn muốn xóa?');"> Xóa</button>
	           {{ Form::close() }}
			</td>
		
		</tr>
		@endforeach
	</table>
@stop