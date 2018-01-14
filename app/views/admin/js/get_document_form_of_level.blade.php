<div class="wrap-multi-file-each-lesson">
	<div class="hidden element-to-clone">
		<div class="item-doc well well-sm" doc-id="@order">
			<fieldset>
				<legend>Phiếu học liệu câu hỏi:</legend>
				<div class="form-group">
					{{ Form::text('doc_new_tile_p['.$lesson.'][@order]', '', ['class' => 'form-control form-group', 'placeholder' => 'Tiêu đề']) }}
					{{ Form::file('doc_new_file_p['.$lesson.'][@order]') }}
				</div>
			</fieldset>
			<fieldset>
				<legend>Phiếu học liệu đáp án:</legend>
				<div class="form-group">
					{{ Form::text('doc_new_title_a['.$lesson.'][@order]', '', ['class' => 'form-control form-group', 'placeholder' => 'Tiêu đề']) }}
					{{ Form::file('doc_new_file_a['.$lesson.'][@order] ') }}
				</div>
			</fieldset>
			<a href="" class="btn btn-warning remove-item-doc pull-right"><i class="fa fa-remove"></i> Xóa</a>
			<div class="clearfix"></div>
		</div>
	</div>
	{{ Form::open(['action' => 'DocumentController@store', 'files' => true, 'class' => 'document-of-level-form']) }}
		<div class="item-list">
			<div class="item-doc well well-sm" doc-id="0">
				<fieldset>
					<legend>Phiếu học liệu câu hỏi:</legend>
					<div class="form-group">
						{{ Form::text('doc_new_tile_p['.$lesson.'][0]', '', ['class' => 'form-control form-group', 'placeholder' => 'Tiêu đề']) }}
						{{ Form::file('doc_new_file_p['.$lesson.'][0]') }}
					</div>
				</fieldset>
				<fieldset>
					<legend>Phiếu học liệu đáp án:</legend>
					<div class="form-group">
						{{ Form::text('doc_new_title_a['.$lesson.'][0]', '', ['class' => 'form-control form-group', 'placeholder' => 'Tiêu đề']) }}
						{{ Form::file('doc_new_file_a['.$lesson.'][0] ') }}
					</div>
				</fieldset>
				<a href="" class="btn btn-warning remove-item-doc pull-right"><i class="fa fa-remove"></i> Xóa</a>
				<div class="clearfix"></div>
			</div>
		</div>
		<button class="btn btn-success" type="submit">Lưu</button>
		<a href="" class="btn btn-default pull-right add-new-doc-to-lesson"><i class="fa fa-plus"></i> Thêm mới học liệu</a>
	{{ Form::close() }}
</div>