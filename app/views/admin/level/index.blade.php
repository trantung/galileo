@extends('admin.layout.default')

@section('css_header')
@parent
{{--  --}}
@stop

@section('title')
Danh sách trình độ
@stop
@section('content')
<a href="{{ action('LevelController@create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới trình độ</a>
<div class="margin-bottom">
    @include('admin.level.filter')
</div>
	<table class="table table-bordered table-responsive">
		<thead>
			<tr class="bg-primary">
				<th width="50px" class="text-center">STT</th>
				<th>Trình độ</th>
				<th>Tên lớp</th>
				<th>Môn học</th>
				<th>Số buổi</th>
				<th width ="200px">Thao tác</th>
			</tr>
		</thead>
		<tbody>
			@if( count($data) )
				@foreach( $data as $key => $level )
					<tr>
						<td>{{ $key+1 }}</td>
						<td>{{ $level->name }}</td>
						<td>{{ Common::getValueOfObject($level, 'classes', 'name') }}</td>
						<td>{{ Common::getValueOfObject($level, 'subjects', 'name') }}</td>
						<td>{{ $level->number_lesson }}</td>
						<td>
							<a href="{{ action('LevelController@show', $level->id) }}" class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> Chi tiết</a>
							<a href=" {{ action('LevelController@edit', $level->id) }} " class="btn btn-info"><i class ="fa fa-edit"></i></a>
							{{ Form::open(['action'=>['LevelController@destroy', $level->id], 'method' => 'DELETE', 'class' => 'inline']) }}
								<button class="btn btn-danger" onclick="return(confirm('Bạn có chắc chắn muốn xóa'));"><i class="fa fa-trash"></i> </button>
							{{ Form::close() }}
						</td>
					</tr>
				@endforeach
			@else
			<div class="alert alert-warning">Không có dữ liệu!</div>
			@endif
		</tbody>
	</table>
	<div class="row">
		<div class="col-xs-12">
			{{ $data->appends(Request::except('page'))->links() }}
		</div>
	</div>
@stop