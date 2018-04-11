@extends('landing_page.default')

@section('title')
{{ $title='Quản lý Langning' }}
@stop
@section('content')
	<!-- Bo loc -->
	<div class="margin-bottom">
        @include('landing_page.filter')
    </div>
	<table class="table table-bordered table-striped table-hove" >
	<div class="margin-bottom">
    </div>
		<tr>
			<th>STT</th>
			<th>Họ và tên mẹ</th>
			<th>Họ và tên HS</th>
			<th>Số điện thoại</th>
			<th>Email</th>
			<th>Lớp</th>
			<th>Giai đoạn 1</td>
			<th>Giai đoạn 2</td>
			<th>Giai đoạn 3</td>
			<th>Giai đoạn 4</td>
			<th>Địa chỉ</td>
			<th>Môn kiểm tra</td>
			<th>Ý kiến</td>
			<th width="10%">Action</th>
		</tr>
		@foreach($data as $key => $value)
		<tr>
			<td>{{ $key + 1 }}</td>
			<td>{{ $value->parent_name }}</td>
			<td>{{ $value->fullname }}</td>
			<td>{{ $value->phone }}</td>
			<td>{{ $value->email }}</td>
			<td>{{ $value->class }}</td>
			<td>{{ $value->period_1 }}</td>
			<td>{{ $value->period_2 }}</td>
			<td>{{ $value->period_3 }}</td>
			<td>{{ $value->period_4 }}</td>
			<td>{{ $value->address }}</td>
			<td>{{ $value->check_subject}}</td>
			<td>{{ $value->comment}}</td>
			<td>
			   {{ Form::open(array('method'=>'DELETE', 'action' => array('LandingPageController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
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
