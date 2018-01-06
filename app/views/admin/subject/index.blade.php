@extends('admin.subject.create')

@section('title')
Danh sách môn học
@stop

@section('content')
	@parent
	<table class="table table-bordered table-responsive">
		<thead>
			<tr class="bg-primary">
				<th width="50px" class="text-center">STT</th>
				<th>Tên môn</th>
				<th>Thao tác</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($data as $key => $subject)
				<tr class="bg-warning">
					<td>{{ $subject->id }}</td>
					<td>{{ $subject->name }}</td>
					<td><a href="{{ action('SubjectController@edit', $subject->id) }}" class="btn btn-primary">Sửa</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop