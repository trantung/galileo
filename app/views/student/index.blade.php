@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý học sinh' }}
@stop
@section('content')
	<!-- Bo loc -->
	<a href="{{ action('StudentController@create') }}" class="btn btn-primary">Thêm học sinh mới</a>
	<table class="table table-bordered table-striped table-hove" >
	<div class="margin-bottom">
        @include('student.filter_student')
    </div>
		<tr>
			<th>STT</th>
			<th>Họ và tên HS</th>
			<th>Mã HS</th>
			<th>Username</th>
			<th>Email</th>
			<th>Ngày sinh</th>
			<th>Giới tính</td>
			<th>Địa chỉ</td>
			<th width="17%">Action</th>
		</tr>
		@foreach($data as $key => $value)
		<tr>
			<td>{{ $key + 1 }}</td>
			<td>{{ $value->fullname }}</td>
			<td>{{ $value->code }}</td>
			<td>{{ $value->username }}</td>
			<td>{{ $value->email }}</td>
			<td>{{ $value->birthday }}</td>
			<td>{{ Common::getNameGender($value->gender) }}</td>
			<td>{{ $value->address }}</td>
			<td>

	           <a href="{{ action('StudentController@show', $value->id) }}" class="btn btn-primary inline-block">Show</a>
	           @if(checkPermissionUserByField('role_id', GV))
	            <a href="{{ action('StudentController@edit', $value->id) }}" class="btn btn-primary inline-block">Sửa</a>
	           @endif
			   {{ Form::open(array('method'=>'DELETE', 'action' => array('StudentController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
	           <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
	           {{ Form::close() }}
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