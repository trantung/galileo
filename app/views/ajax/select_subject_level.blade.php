@section('style_header')
@parent
{{ HTML::style( asset('custom/css/style.css') ) }}
@stop

@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

<div class="js-multi-field">
	<div class="input-wrap">
		@if( isset($data) && count($data->subjects) )
			@foreach( $data->subjects as $subject )
				<div class="item select-subject-wrapper" data-syn="#syn">
					{{ Form::select('subject[]', [''=>'-- Chọn --'] + $subjects, $subject->id, ['class' => 'form-control', 'id' => 'syn', 'disabled' => true]) }}
					<button type="button" class="btn btn-danger remove remove-ajax" class-id="{{ $data->id }}" subject-id="{{ $subject->id }}"><i class="glyphicon glyphicon-remove"></i></button>
					<div class="select-level">
						<div class="js-multi-field">
				            <div class="input-wrap">
								@foreach( Common::getLevelBySubject($data->id, $subject->id) as $level )
					                <div class="item select-level-wrapper" data-syn="#syn">
					                    <label class="inline-block">Trình độ: </label>
					                    {{ Form::text('level['.$subject->id.'][' . $level->id .']', $level->name, ['class'=>'form-control inline-block', 'style'=>'width:350px']) }}
					                    <a class="btn btn-danger remove remove-ajax" data-id="{{ $level->id }}"><i class="glyphicon glyphicon-remove"></i></a>
					                </div>
								@endforeach
				            </div>
				            <button class="btn btn-success add-new edit" type="button"><i class="glyphicon glyphicon-plus"></i> Thêm mới trình độ</button>
				        </div>
					</div>
				</div>
			@endforeach
		@else
			<div class="item select-subject-wrapper" data-syn="#syn">
				{{ Form::select('subject[]', [''=>'-- Chọn --'] + $subjects, '', ['class' => 'form-control', 'id' => 'syn']) }}
				<button type="button" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i></button>
				<div class="select-level">
					
				</div>
			</div>
		@endif
	</div>
	<button class="btn btn-success add-new" type="button"><i class="glyphicon glyphicon-plus"></i> Thêm mới môn học</button>
</div>
