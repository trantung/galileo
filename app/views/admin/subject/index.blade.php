@extends('admin.subject.create')

@section('title')
Danh sách môn học
@stop

@section('content')
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('ClassController@create') }}" class="btn btn-primary">Thêm mới lớp học</a>
    </div>
</div>
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
					<td>
					{{ app('html')->linkAction('SubjectController@edit', 'Sửa', $subject->id, ['class'=>"btn btn-primary"]) }}
					{{ Form::open(array('method'=>'DELETE', 'action' => array('SubjectController@destroy', $subject->id), 'style' => 'display: inline-block;')) }}
						<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
						</td>
					{{ Form::close() }}
				</tr>
			@endforeach
		</tbody>
	</table>
@stop