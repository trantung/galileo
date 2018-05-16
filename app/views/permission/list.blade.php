@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý phân quyền' }}
@stop
@section('content')
	{{-- <div class="row margin-bottom">
	    <div class="col-xs-12">
	    	{{ renderUrl('PermissionController@listRole', 'Quản lý nhóm quyền', [], ['class' => 'btn btn-primary']) }}
	    </div>
	</div> --}}
	<div class="box box-primary">
		{{ Form::open(array('action' => array('PermissionController@store'), 'method' => "POST")) }}
			<div class="box-body">
				<table class ="table table-bordered table-striped table-hover sticky-table">
					<thead>
						<tr>
							<th width="450">Quyền truy cập</th>
							@foreach ($roles as $slug => $name)
								<th class="text-center {{ ( $slug == ADMIN | $slug == DEV ) ? 'hidden' : '' }}">{{ $name }}</th>
							@endforeach
						</tr>
					</thead>
					<tbody>
						@foreach (getAllPermissions() as $key => $element)
							<tr>
								<td>
									{{ $element['name'] }}
									{{ !empty($element['description']) ? '<p style="font-size: 12px"><i>'.$element['description'].'</i></p>' : '' }}
								</td>
								@foreach ($roles as $slug => $name)
									@if($slug == ADMIN | $slug == DEV)
										<td title="{{ $element['description'] }}" class="text-center hidden" >
											<input type="checkbox" name="permission[{{ $key }}][{{ $slug }}]" value="1" checked }}>
										</td>
									@else
										<td title="{{ $element['description'] }}" width="135px" class="text-center" style="vertical-align: middle;">
											<input type="checkbox" name="permission[{{ $key }}][{{ $slug }}]" value="1" {{ (hasRoleAccess($slug, $key) ) ? 'checked' : '' }}>
										</td>
									@endif
								@endforeach
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="box-footer">
	            <button type="submit" class="btn btn-primary">Lưu lại</button>
	        </div>
		{{ Form::close() }}
	</div>
@stop