<div class="wrap-multi-file-each-lesson">
	<div class="hidden element-to-clone">
		<div class="item-doc well well-sm" doc-id="@order">
			{{ Form::hidden('lesson_id', Common::getObject($lesson, 'id')) }}
			{{ Form::hidden('class_id', Common::getObject($lesson, 'class_id')) }}
			{{ Form::hidden('subject_id', Common::getObject($lesson, 'subject_id')) }}
			{{ Form::hidden('level_id', Common::getObject($lesson, 'level_id')) }}
			<fieldset>
				<legend>Phiếu học liệu câu hỏi:</legend>
				<div class="form-group">
					{{ Form::text('doc_new_title_p['.Common::getObject($lesson, 'id').'][@order]', '', ['class' => 'form-control form-group', 'placeholder' => 'Tiêu đề']) }}
					{{ Form::file('doc_new_file_p['.Common::getObject($lesson, 'id').'][@order]', ['class' => 'form-control']) }}
				</div>
			</fieldset>
			<fieldset>
				<legend>Phiếu học liệu đáp án:</legend>
				<div class="form-group">
					{{ Form::text('doc_new_title_d['.Common::getObject($lesson, 'id').'][@order]', '', ['class' => 'form-control form-group', 'placeholder' => 'Tiêu đề']) }}
					{{ Form::file('test_d['.Common::getObject($lesson, 'id').'][@order] ', ['class' => 'form-control']) }}
				</div>
			</fieldset>
			<a href="#" class="btn btn-warning remove-item-doc no-ajax pull-right"><i class="fa fa-remove"></i> Xóa</a>
			<div class="clearfix"></div>
		</div>
	</div>
	{{ Form::open(['action' => 'DocumentController@store', 'files' => true, 'class' => 'document-of-lesson-form']) }}
		<div class="item-list">
			<div class="item-doc well well-sm" doc-id="0">
				{{ Form::hidden('lesson_id', Common::getObject($lesson, 'id')) }}
				{{ Form::hidden('class_id', Common::getObject($lesson, 'class_id')) }}
				{{ Form::hidden('subject_id', Common::getObject($lesson, 'subject_id')) }}
				{{ Form::hidden('level_id', Common::getObject($lesson, 'level_id')) }}
				<fieldset>
					<legend>Phiếu học liệu câu hỏi:</legend>
					<div class="form-group">
						{{ Form::text('doc_new_title_p['.Common::getObject($lesson, 'id').'][0]', '', ['class' => 'form-control form-group', 'placeholder' => 'Tiêu đề']) }}
						{{ Form::file('doc_new_file_p['.Common::getObject($lesson, 'id').'][0]', ['class' => 'form-control']) }}
					</div>
				</fieldset>
				<fieldset>
					<legend>Phiếu học liệu đáp án:</legend>
					<div class="form-group">
						{{ Form::text('doc_new_title_d['.Common::getObject($lesson, 'id').'][0]', '', ['class' => 'form-control form-group', 'placeholder' => 'Tiêu đề']) }}
						{{ Form::file('test_d['.Common::getObject($lesson, 'id').'][0]', ['class' => 'form-control']) }}
					</div>
				</fieldset>
				<a href="#" class="btn btn-warning remove-item-doc no-ajax pull-right"><i class="fa fa-remove"></i> Xóa</a>
				<div class="clearfix"></div>
			</div>
		</div>
		<button class="btn btn-success" type="submit">Lưu</button>
		<a href="#" class="btn btn-default pull-right add-new-doc-to-lesson"><i class="fa fa-plus"></i> Thêm mới học liệu</a>
	{{ Form::close() }}
</div>