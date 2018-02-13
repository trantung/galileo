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
			<th>Email</th>
			<th>Họ tên bố/mẹ</th>
			<th>Phone</th>
			<th>Giới tính</td>
			<th>Địa chỉ</td>
			<th width="140px">Action</th>
		</tr>
		@foreach($data as $key => $value)
			<tr>

				<td>{{ $key + 1 }}</td>
				<td>{{ $value->fullname }}</td>
				<td>{{ $value->code }}</td>
				<td>{{ $value->birthday }}</td>
				<td>{{ $value->gender }}</td>
				<td>{{ $value->address }}</td>
				<td>
					@foreach(StudentLevel::where('student_id', $value->id)->get() as $studentLevel)
						{{ Common::getObject($studentLevel->subjects, 'name').' '.Common::getObject($studentLevel->levels, 'name') }}, 
					@endforeach</td>
				<td>
		           <a href="{{ action('StudentController@edit', $value->id) }}" class="btn btn-primary">Edit</a>
				   {{ Form::open(array('method'=>'DELETE', 'action' => array('StudentController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
		           <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
		           {{ Form::close() }}
				</td>
			
			</tr>
		@endforeach
	</table>
@stop