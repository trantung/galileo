@extends('admin.layout.default')

@section('css_header')
@parent
{{--  --}}
@stop

@section('title')
Danh sách lớp học
@stop
@section('content')
<div class="margin-bottom">
    bộ lọc
</div>
	<table class="table table-bordered table-responsive">
		<thead>
			<tr class="bg-primary">
				<th width="50px" class="text-center">STT</th>
				<th>Trình độ</th>
				<th>Tên lớp</th>
				<th>Môn học</th>
				<th>Số buổi</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@if( count($data) )
				@foreach( $data as $key => $level )
					<tr>
						<td>{{ $key+1 }}</td>
						<td>{{ $level->name }}</td>
						<td>{{ CommonNormal::getValueOfObject($level, 'classes', 'name') }}</td>
						<td>{{ CommonNormal::getValueOfObject($level, 'subjects', 'name') }}</td>
						<td>{{ $level->number_lession }}</td>
						<td></td>
					</tr>
				@endforeach
			@else
			<div class="alert alert-warning">Không có dữ liệu!</div>
			@endif
		</tbody>
	</table>
@stop