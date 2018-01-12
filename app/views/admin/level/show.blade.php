@extends('admin.layout.default')

@section('css_header')
@parent
{{--  --}}
@stop

@section('title')
Chi tiết trình độ <strong>{{ $data->name.', '.$data->subjects->name.', '.$data->classes->name }}</strong>
@stop

@section('content')
	<div class="margin-bottom">
		<a href="{{ action('LevelController@index') }}" class="btn btn-primary">Danh sách trình độ</a>
	</div>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">

			<div class="col-sm-6">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="heading1">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
									Buổi 1
								</a>
							</h4>
						</div>
						<div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
							<div class="panel-body">
								{{ Form::open(['action' => 'Lession']) }}
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>
	    	</div> {{-- End panel left --}}
    	</div> {{-- End row --}}

    </div> {{-- End panel-body --}}
</div> {{-- End panel --}}
@stop