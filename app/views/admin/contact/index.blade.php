@extends('admin.layout.default')

@section('title')
{{ $title='Liên hệ phản hồi' }}
@stop

@section('content')

<div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
		  <h3 class="box-title">Danh sách phản hồi</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
		  <table class="table table-hover">
			<tr>
			  <th>ID</th>
			  <th>Tên</th>
			  <th>Email</th>
			  <th>Phone</th>
			  <th>Message</th>
			  <th>Time </th>
			  <th style="width:200px;">Action</th>
			</tr>
			@foreach($data as $value)
				<tr>
				  <td>{{ $value->id }}</td>
				  <td>{{ $value->name }}</td>
				  <td>{{ $value->email }}</td>
				  <td>{{ $value->phone }}</td>
				  <td>{{ nl2br($value->message)}}</td>
				  <td>{{ $value->created_at}}</td>
				  <td>
					{{ Form::open(array('method'=>'DELETE', 'action' => array('AdminContactController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
					<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
					{{ Form::close() }}
				  </td>
				</tr>
			@endforeach
		  </table>
		</div>
		<!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
</div>

@stop

