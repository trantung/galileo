@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý học sinh' }}
@stop
@section('content')
	
	<!-- Bo loc -->

	<a href="{{ action('StudentController@create') }}" class="btn btn-primary " style=" background-color: green">Thêm học sinh mới</a>
	<table class ="table table-bordered table-striped table-hover table-responsive ">
		<tr>
			<th>STT</th>
			<th>Họ và tên HS</th>
			<th>Family Id</th>
			<th>Mã HS</th>
			<th>Tên đăng nhập</th>
			<th>Email</th>
			{{-- <th>Số điện thoại</th> --}}
			<th>Họ tên bố</th>
			<th>Họ tên mẹ</th>
			<!-- <th>Trung tâm</th> -->
			<!-- <th>Lớp</td> -->
			<!-- <th>Ngày nhập học</td> -->
			<!-- <th>Nguồn</td> -->
			<!-- <th>Ngày sinh</td> -->
			<th>Giới tính</td>
			<th>Địa chỉ</td>
			<!-- <th>Link facebook</td> -->
			<!-- <th>Thông tin người đón</th> -->
			<th>Lưu ý về học sinh</th>
			<!-- <th>Chương trình đang học</th> -->
			<th>Mục tiêu</th>
			<th width="140px">Action</th>
		</tr>
		@foreach($data as $key => $value)
		<tr>

			<td>{{ $key + 1 }}</td>
			<td>{{ $value->fullname }}</td>
			<td>{{ $value->family_id }}</td>
			<td>{{ $value->code }}</td>
			<td>{{ $value->username }}</td>
			<td>{{ $value->email }}</td>
			{{-- <td>{{ $value->phone }}</td> --}}
			<td>{{ Common::getObject($value->family, 'fullname') }}</td>
			<td>{{ Common::getObject($value->family, 'phone') }}</td>
			<!-- <td>{{ Common::getObject($value->centers, 'name') }}</td> -->
			<!-- <td>{{ Common::getObject($value->classes, 'name') }}</td> -->
			<!-- <td>{{ $value->date_study }}</td> -->
			<!-- <td>{{ $value->model_name }}</td> -->
			<!-- <td>{{ $value->birthday }}</td> -->
			<td>{{ $value->gender }}</td>
			<td>{{ $value->address }}</td>
			<!-- <td>{{ $value->link_fb }}</td> -->
			<!-- <td>{{ $value->info_user }}</td> -->
			<td>{{ $value->comment }}</td>
			<!-- <td>
				@foreach(StudentLevel::where('student_id', $value->id)->where('status', 1)->get() as $studentLevel)
					{{ Common::getObject($studentLevel->subjects, 'name').' '.Common::getObject($studentLevel->levels, 'name') }}, 
				@endforeach</td> -->
			<td>{{ $value->description }}</td>
			<td>
	           <a href="{{ action('StudentController@edit', $value->id) }}" class="btn btn-primary">Edit</a>
			   {{ Form::open(array('method'=>'DELETE', 'action' => array('StudentController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
	           <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Delete</button>
	           {{ Form::close() }}
			</td>
		
		</tr>
		@endforeach
	</table>
@stop