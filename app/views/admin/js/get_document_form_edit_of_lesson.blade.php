<div class="item-doc well well-sm">
	{{ Form::hidden('lesson_id', Common::getObject($lesson, 'id')) }}
	{{ Form::hidden('class_id', Common::getObject($lesson, 'class_id')) }}
	{{ Form::hidden('subject_id', Common::getObject($lesson, 'subject_id')) }}
	{{ Form::hidden('level_id', Common::getObject($lesson, 'level_id')) }}

	@if( !isset($group) )
		{{-- Form create --}}
		<?php if( !isset($order) ){
			$order = '';
		} ?>
		<fieldset>
			<legend>Phiếu học liệu câu hỏi:</legend>
			<div class="form-group">
				{{ Form::text('doc_new_title_p['. Common::getObject($lesson, 'id') .']['. $order .']', '', ['class' => 'form-control form-group', 'placeholder' => 'Tiêu đề', 'required' => 'required']) }}
				{{ Form::file('doc_new_file_p['. Common::getObject($lesson, 'id') .']['. $order .']', ['class' => 'form-control', 'required' => 'required']) }}
			</div>
		</fieldset>
		<fieldset>
			<legend>Phiếu học liệu đáp án:</legend>
			<div class="form-group">
				{{ Form::text('doc_new_title_d['. Common::getObject($lesson, 'id') .']['. $order .']', '', ['class' => 'form-control form-group', 'placeholder' => 'Tiêu đề']) }}
				{{ Form::file('doc_new_file_d['. Common::getObject($lesson, 'id') .']['. $order .']', ['class' => 'form-control']) }}
			</div>
		</fieldset>
		<a href="#" class="btn btn-warning remove-item-doc no-ajax pull-right"><i class="fa fa-remove"></i> Xóa</a>
		<div class="clearfix"></div>
	@else
		{{-- Form edit --}}
		<fieldset>
			<legend>Phiếu học liệu câu hỏi:</legend>
			<div class="form-group">
				<p><label>Tên tài liệu: </label> {{ Common::getObject($group['P'], 'name') }}</p>
				<p><label>Mã phiếu: </label> <a href="{{ action('DocumentController@edit', [Common::getObject($group['P'], 'id')]) }}">{{ Common::getObject($group['P'], 'code') }}</a></p>
			</div>
		</fieldset>
		<fieldset>
			<legend>Phiếu học liệu đáp án:</legend>
			<div class="form-group">
				<p><label>Tên tài liệu: </label> {{ Common::getObject($group['D'], 'name') }}</p>
				<p><label>Mã phiếu: </label> <a href="{{ action('DocumentController@edit', [Common::getObject($group['D'], 'id')]) }}">{{ Common::getObject($group['D'], 'code') }}</a></p>
			</div>
		</fieldset>
		{{-- <a href="#" class="btn btn-warning remove-item-doc no-ajax pull-right"><i class="fa fa-remove"></i> Xóa</a> --}}
		{{-- <div class="clearfix"></div> --}}
	@endif
</div>