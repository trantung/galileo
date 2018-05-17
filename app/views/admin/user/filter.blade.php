<div class="box alert">
	{{ Form::open(['action' => 'ManagerUserController@index', 'method' => 'GET', 'class' => 'filter-document-form']) }}
		<div class="input-group inline-block">
            <label>Từ khóa</label>
            {{ Form::text('key', Input::get('key') , ['class' => 'form-control', 'placeholder' => 'Username, Email, Full name, ...']) }}
        </div>
        <div class="input-group inline-block">
            <label>Quyền</label>
            {{ Form::select('role_id', ['' => '-- Chọn --'] + Common::getRoleUser(), Input::get('role_id') , ['class' => 'form-control']) }}
        </div>
        <div class="input-group inline-block">
            <label>Trung tâm</label>
            {{ Form::select('center_id', ['' => '-- Chọn --'] + Common::getListCenter(), Input::get('center_id') , ['class' => 'form-control']) }}
        </div>
		<div class="input-group inline-block" style="vertical-align: bottom;">
			<button type="submit" class="btn btn-primary">Tìm kiếm</button>
			{{ link_to_action('ManagerUserController@index', 'Reset', null, ['class' => 'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
</div>