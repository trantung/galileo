@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý học sinh' }}
@stop
@section('content')
	<!-- Bo loc -->
	@if(checkPermissionUserByField('role_id', GV))
	<a href="{{ action('StudentController@create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm học sinh mới</a>
	@endif
	<div class="margin-bottom">
        @include('student.filter')
    </div>
	<table class="table table-bordered table-striped table-hove" >
	<div class="margin-bottom">
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
			<th width="20%">Action</th>
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
           		{{ renderUrl('StudentController@show', '<i class="fa fa-eye"></i> Chi tiết', [$value->id], ['class' => 'btn btn-default inline-block']) }}
           		{{ renderUrl('StudentController@edit', '<i class="fa fa-edit"></i> Sửa', [$value->id], ['class' => 'btn btn-primary inline-block']) }}
           		@if( userAccess('student.manage.own.delete') | userAccess('student.manage') )
		   		{{ Form::open(array('method'=>'DELETE', 'action' => array('StudentController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
	        		<button class="btn btn-danger " onclick="return confirm('Bạn có chắc chắn muốn xóa?');"><i class ="fa fa-trash"></i> Xóa</button>
           		{{ Form::close() }}
           		@endif
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
