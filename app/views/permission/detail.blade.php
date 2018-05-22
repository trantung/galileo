@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý phân quyền' }}
@stop
@section('content')
	<div class="row margin-bottom">
	    <div class="col-xs-12">
	    	{{ renderUrl('RoleController@index', 'Quản lý nhóm quyền', [], ['class' => 'btn btn-primary']) }}
	    </div>
	</div>
	<div class="box box-primary">
		{{ Form::open(array('action' => array('PermissionController@updateRole', $role->slug ), 'method' => "PUT")) }}
			<div class="box-body">
				<table class ="table table-bordered table-striped table-hover sticky-table">
					<thead>
						<tr>
							<th>Quyền truy cập</th>
							<th width="135px" class="text-center">{{ $role->name }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach (getAllPermissions() as $key => $element)
							<tr>
								<td>
									{{ $element['name'] }}
									{{ !empty($element['description']) ? '<p><i>'.$element['description'].'</i></p>' : '' }}
								</td>
								<td title="{{ $element['description'] }}" width="135px" class="text-center" style="vertical-align: middle;">
									<input type="checkbox" name="permission[{{ $key }}][{{ $role->slug }}]" value="1" {{ ( $role->slug == ADMIN ) ? 'disabled' : '' }} {{ ( $role->slug == ADMIN | hasRoleAccess($role->slug, $key) ) ? 'checked' : '' }}>
								</td>
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