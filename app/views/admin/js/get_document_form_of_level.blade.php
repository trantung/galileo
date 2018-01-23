{{-- {{ dd($lesson->documents) }} --}}
<div class="wrap-multi-file-each-lesson">
	<div class="hidden element-to-clone">
		@include('admin.js.get_document_form_edit_of_lesson', ['order' => '@order', 'lesson' => $lesson])
	</div>
	{{ Form::open(['action' => 'DocumentController@store', 'files' => true, 'class' => 'document-of-lesson-form']) }}
		<div class="item-list">
			@if( count($lesson->documents) )
				@foreach( Common::getDocumentByLesson($lesson->id) as $group )
					@include('admin.js.get_document_form_edit_of_lesson', ['group' => $group, 'lesson' => $lesson])
				@endforeach
			@else
				@include('admin.js.get_document_form_edit_of_lesson', ['lesson' => $lesson])
			@endif
		</div>
		<button class="btn btn-success" type="submit">Lưu</button>
		<a href="#" class="btn btn-default pull-right add-new-doc-to-lesson"><i class="fa fa-plus"></i> Thêm mới học liệu</a>
	{{ Form::close() }}
</div>