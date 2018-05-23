@extends('admin.layout.default')

@section('css_header')
@parent
{{--  --}}
@stop

@section('title')
Danh sách lớp học
@stop
@section('content')
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('ClassController@create') }}" class="btn btn-primary"><li class="fa fa-plus"></li> Thêm mới lớp học</a>
    </div>
</div>
	<table class="table table-bordered table-responsive">
		<thead>
			<tr class="bg-primary">
				<th width="50px" class="text-center">STT</th>
				<th>Tên lớp</th>
				<th>Môn học</th>
				<th>Trình độ</th>
				<th style="width: 150px">Thao tác</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($data as $key => $class)
				<?php $countSubject = count($class->subjects); ?>
				
					<tr class="bg-warning">
						<td rowspan="{{ $countSubject }}" class="text-center"><strong>{{ $key+1 }}</strong></td>
						<td rowspan="{{ $countSubject }}">{{ $class->name }}</td>
						<td>{{ ($countSubject) ? $class->subjects[0]->name : '' }}</td>
						<td>
							@if ($countSubject)
								{{ Common::renderLevelBySubject($class->id, $class->subjects[0]->id) }}
							@endif
						</td>
						<td rowspan="{{ $countSubject }}"><a href="{{ action('ClassController@edit', $class->id) }}" class="btn btn-info"><li class="fa fa-edit"></li></a>
							{{ Form::open(array('method'=>'DELETE', 'action' => array('ClassController@destroy', $class->id), 'style' => 'display: inline-block;')) }}
								<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');"><li class="fa fa-trash"></li></button>
								</td>
							{{ Form::close() }}
						</td>
					</tr>
				@if( $countSubject > 1 )
					@for ($i = 1; $i < $countSubject; $i++)
						<tr class="bg-warning">
							<td>{{ Common::getObject($class->subjects[$i], 'name') }}</td>
							<td>{{ Common::renderLevelBySubject($class->id, $class->subjects[$i]->id) }}</td>
						</tr>
					@endfor
				@endif
			@endforeach
		</tbody>
	</table>
@stop