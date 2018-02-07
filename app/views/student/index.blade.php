@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý học sinh' }}
@stop
@section('content')

	<a href="{{ action('StudentController@create') }}" class="btn btn-primary " style=" background-color: green">Thêm học sinh mới</a>
	<table class ="table table-bordered table-striped table-hover">
		<table class ="table table-bordered table-striped table-hover">
	<tr>
		<th>Stt</th>
		<th>Họ và tên HS</th>
		<th>Mã Hs</th>
		<th>Lớp</th>
		<th>Ngày nhập học</th>
		<th>Nguồn</th>
		<th>Ngày sinh</th>
		<th>Giới tính</th>
		<th>Địa chỉ hiện tại</th>
		<th>Trường học</th>
		<th>Họ và tên bố</th>
		<th>SĐT bố</th>
		<th>Họ và tên mẹ</th>
		<th>SDT mẹ</th>
		<th>Email nhạn thông tin</th>
		<th>Link FB</th>	
		<th>Mục tiên sau khi học tai trung tâm</th>
		<th>Thời gian cần đạt mục tiêu</th>
		<th>Thông tin người đón</th>
		<th>Lưu ý về học sinh</th>
		<th>tùy chọn</th>

	
	</tr>
	<tr>
		
		
	</tr>

</table>
		@foreach($data as $key => $value)
		<tr>
			<td>Stt</td>
			<td>Họ và tên học sinh</td>
			<td>Mã Hs</td>
			<td>Lớp</td>
			<td>Ngày nhập học</td>
			<td>Nguồn</td>
			<td>Ngày sinh</td>
			<td>Giới tính</td>
			<td>Địa chỉ hiện tại</td>
			<td>Trường học</td>
			<td>Họ và tên bố</td>
			<td>SĐT bố</td>
			<td>Họ và tên mẹ</td>
			<td>SDT mẹ</td>
			<td>Email nhạn tdông tin</td>
			<td>Linh FBPH</td>
			<td>Tên FBPH</td>
			<td>Mục tiên sau khi học tai trung tâm</td>
			<td>Tdời gian cần đạt mục tiêu</td>
			<td>Tdông tin người đón</td>
			<td>Lưu ý về học sinh</td>
			
			<td>
	           <a href="{{ action('StudentController@edit', $value->id) }}" class="btn btn-danger">Sửa</a>
			</td>
			<td>
			   {{ Form::open(array('method'=>'DELETE', 'action' => array('StudentController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
	           <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
	           {{ Form::close() }}
			</td>
		
		</tr>
		@endforeach
	</table>
@stop