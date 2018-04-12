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
	Có tất cả {{ $count }} dữ liệu
    </div>
		<tr>
			<th>STT</th>
			<th>Họ và tên mẹ</th>
			<th>Họ và tên HS</th>
			<th>Số điện thoại</th>
			<th>Email</th>
			<th>Lớp</th>
			<th>Đợt thi</td>
			<th>Địa điểm thi</td>
			<th>Môn kiểm tra</td>
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
			<td>{{ CommonLanding::getPeriodStudent($value) }}</td>
			<td>{{ CommonLanding::getAddressName($value->address) }}</td>
			<td>{{ CommonLanding::getSubjectName($value->check_subject) }}</td>
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
