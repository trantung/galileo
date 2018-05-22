<div class="box alert">
	{{ Form::open(['action' => 'AdminController@index', 'method' => 'GET', 'class' => 'filter-document-form']) }}
		<div class="input-group inline-block">
            <label>Từ khóa</label>
            {{ Form::text('key', Input::get('key') , ['class' => 'form-control', 'placeholder' => 'Username, Email, ...']) }}
        </div>
        <div class="input-group inline-block">
            <label>Quyền</label>
            {{ Form::select('role_id', ['' => '-- Chọn --'] + Common::getRoleAdmin(), Input::get('role_id') , ['class' => 'form-control']) }}
        </div>
		<div class="input-group inline-block" style="vertical-align: bottom;">
			<button type="submit" class="btn btn-primary">Tìm kiếm</button>
			{{ link_to_action('AdminController@index', 'Reset', null, ['class' => 'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
</div>