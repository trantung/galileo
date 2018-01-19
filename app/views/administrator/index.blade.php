@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý admin' }}
@stop
@section('content')

	<a href="{{ action('AdminController@create') }}" class="btn btn-primary " style=" background-color: green">Thêm người dùng mới</a>
	<table class ="table table-bordered table-striped table-hover">
		<tr>
			<th>Username</th>
			<th>Email</th>
			<th>Edit</th>
			<th>Delete</th>
			<th>Reset password</th>
		</tr>
		@foreach($data as $key => $value)
		<tr>
			<td>{{ $value->username }}</td>
			<td>{{ $value->email }}</td>
			<td>
	           <a href="{{ action('AdminController@edit', $value->id) }}" class="btn btn-primary">Edit</a>
			</td>
			<td>
			   {{ Form::open(array('method'=>'DELETE', 'action' => array('AdminController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
	           <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn methoduốn xóa?');">Delete</button>
	           {{ Form::close() }}
	        </td>
	        <td>
	           <a href=" {{ action('AdminController@getResetPass', $value->id) }} " class="btn btn-warning">Reset password</a>
		    </td>
					
		</tr>
		@endforeach
	</table>
@stop