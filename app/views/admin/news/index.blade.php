@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý tin' }}
@stop

@section('content')
@include('admin.news.search')
<!-- inclue Search form

-->
@if(!Admin::isSeo())
<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ action('NewsController@create') }}" class="btn btn-primary">Thêm mới tin</a>
	</div>
</div>
@endif
<div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
		  <h3 class="box-title">Danh sách loại tin</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
		  <table class="table table-hover">
			<tr>
			  <th>ID</th>
			  <th>Tên Vietnamese</th>
			  <th>Tên English</th>
			  <th>Vị trí sắp xếp</th>
			  <th>Thể loại</th>
			  <th>Hiển thị</th>
			  <th style="width:200px;">Action</th>
			</tr>
			@if(!empty($input))
				@foreach($inputNew as $value)
					<tr>
						<td>{{ $value->id }}</td>
						<td>{{ $value->name }}</td>
						<td>@if(NewsManager::getNameEnglish($value->id))
							{{ NewsManager::getNameEnglish($value->id) }}
							@endif
						</td>
						<td>{{ $value->position }}</td>
						<td>{{ TypeNew::find($value->type_new_id)->name }}</td>
						<td>{{ getNameStatus($value->status) }}</td>
						<td>
							<a href="{{  action('NewsController@edit', $value->id) }}" class="btn btn-primary">Sửa</a>
							@if(!Admin::isSeo())
								{{ Form::open(array('method'=>'DELETE', 'action' => array('NewsController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
								<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
								{{ Form::close() }}
							@endif
						</td>
					</tr>
				@endforeach
			@else
				@foreach($inputNew as $value)
					<tr>
						<td>{{ returnObjectLanguage($value, 'vi', 'AdminNew')->id }}</td>
						<td>{{ returnObjectLanguage($value, 'vi', 'AdminNew')->name }}</td>
						<td>{{ returnObjectLanguage($value, 'en', 'AdminNew')->name }}</td>
						<td>{{ $value->position }}</td>
						<td>{{ TypeNew::find(returnObjectLanguage($value, 'vi', 'AdminNew')->type_new_id)->name }}</td>
						<td>{{ getNameStatus($value->status) }}</td>
						<td>
							<a href="{{  action('NewsController@edit', returnObjectLanguage($value, 'vi', 'AdminNew')->id) }}" class="btn btn-primary">Sửa</a>
							@if(!Admin::isSeo())
								{{ Form::open(array('method'=>'DELETE', 'action' => array('NewsController@destroy', returnObjectLanguage($value, 'vi', 'AdminNew')->id), 'style' => 'display: inline-block;')) }}
								<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
								{{ Form::close() }}
							@endif
						</td>
					</tr>
				@endforeach
			@endif
		  </table>
		</div>
		<!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<ul class="pagination">
		<!-- phan trang -->
		{{ $inputNew->appends(Request::except('page'))->links() }}
		</ul>
	</div>
</div>

@stop

