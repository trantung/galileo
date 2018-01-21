@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý học sinh' }}
@stop
@section('content')

	<a href="{{ action('StudentController@create') }}" class="btn btn-primary " style=" background-color: green">Thêm học sinh mới</a>
	<table class ="table table-bordered table-striped table-hover table-responsive ">
		<tr>
			<th>Họ và tên HS</th>
			<th>Mã HS</th>
			<th>Tên đăng nhập</th>
			<th>Email</th>
			<th>Số điện thoại</th>
			<th>Trung tâm</th>
			<th>Lớp</td>
			<th>Mục tiêu</th>
			<th>Môn đang học</th>
			<th>Chương trình đang học</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		@foreach($data as $key => $value)
		<tr>
			<td>{{ $value->fullname }}</td>
			<td>{{ $value->code }}</td>
			<td>{{ $value->username }}</td>
			<td>{{ $value->email }}</td>
			<td>{{ $value->phone }}</td>
			<td>{{ $value->centers->name }}</td>
			<td>{{ $value->classes->name }}</td>
			<td>{{ $value->description }}</td>	
			<td>
				@foreach($value->levels as $level)
					{{ $level->id.', ' }}
				
				@endforeach
			</td>
			<td>{{ $value->program_current }}</td>
			<td>
	           <a href="{{ action('StudentController@edit', $value->id) }}" class="btn btn-danger">Edit</a>
			</td>
			<td>
			   {{ Form::open(array('method'=>'DELETE', 'action' => array('StudentController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
	           <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Delete</button>
	           {{ Form::close() }}
			</td>
		
		</tr>
		@endforeach
	</table>
@stop