@extends('admin.layout.default')

@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

@section('title')
Chi tiết trình độ | {{ $data->name.', '.$data->subjects->name.', '.$data->classes->name }}
@stop

@section('content')
	<div class="margin-bottom">
		<a href="{{ action('LevelController@index') }}" class="btn btn-primary">Danh sách trình độ</a>
	</div>
<div class="panel panel-default">
	<div class="panel-body">
		@if( count($data->lessons) )
			<?php $countLesson = count($data->lessons); ?>
			<div class="row">
				<div class="col-sm-6">
					<div class="panel-group" id="accordion-left" role="tablist" aria-multiselectable="true">
						@for ($i = 0; $i < floor($countLesson/2) ; $i++)
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="heading{{ $i }}">
									<h4 class="panel-title">
										<a role="button" data-toggle="collapse" data-parent="#accordion-left" href="#collapse{{ $i }}" aria-expanded="false" aria-controls="collapse{{ $i }}">
											Buổi {{ $i+1 }}
										</a>
									</h4>
								</div>
								<div id="collapse{{ $i }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $i }}">
									<div class="panel-body">
										@include('admin.js.get_document_form_of_level', ['lesson' => $data->lessons[$i]])
									</div>
								</div>
							</div>
	    				@endfor
					</div> {{-- End panel-group --}}
		    	</div> {{-- End panel left --}}
				
				<div class="col-sm-6">
					<div class="panel-group" id="accordion-right" role="tablist" aria-multiselectable="true">
						@for ($i = floor($countLesson/2); $i < $countLesson ; $i++)
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="heading{{ $i }}">
									<h4 class="panel-title">
										<a role="button" data-toggle="collapse" data-parent="#accordion-right" href="#collapse{{ $i }}" aria-expanded="false" aria-controls="collapse{{ $i }}">
											Buổi {{ $i+1 }}
										</a>
									</h4>
								</div>
								<div id="collapse{{ $i }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $i }}">
									<div class="panel-body">
										@include('admin.js.get_document_form_of_level', ['lesson' => $data->lessons[$i]])
									</div>
								</div>
							</div>
	    				@endfor
					</div> {{-- End panel-group --}}
	    		</div> {{-- End panel right --}}
    		</div> {{-- End row --}}
	    @else
			<div class="alert alert-warning">Chưa có buổi học nào được cài đặt cho trình độ này!</div>
	    @endif

    </div> {{-- End panel-body --}}
</div> {{-- End panel --}}
@stop