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
			<th>Phone</th>
			
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		@foreach($data as $key => $value)
		<tr>
			<td>{{ $value->username }}</td>
			<td>{{ $value->email }}</td>
			<td>{{ $value->phone }}</td>
			
			<td>
	           <a href="{{ action('AdminController@edit', $value->id) }}" class="btn btn-danger">Edit</a>
			</td>
			<td>
			   {{ Form::open(array('method'=>'DELETE', 'action' => array('AdminController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
	           <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Delete</button>
	           {{ Form::close() }}
			</td>
		
		</tr>
		@endforeach
	</table>
@stop