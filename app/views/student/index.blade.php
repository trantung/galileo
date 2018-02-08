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
		<td>{{ $value->email }}</td>
		<td>{{ Common::getObject($value->family, 'fullname') }}</td>
		<td>{{ Common::getObject($value->family, 'phone') }}</td>
		<td>{{ Common::getNameGender($value->gender) }}</td>
		<td>{{ $value->address }}</td>
		<td>
		   {{ Form::open(array('method'=>'DELETE', 'action' => array('StudentController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
           <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Delete</button>
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