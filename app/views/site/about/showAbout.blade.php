@extends('site.layout.default')

@section('title')
	{{ $title = trans('captions.contact'); }}
@stop

@section('content')

<div class="main about">
	<div class="container">
		<div class="row">
			@foreach(getTypeLanguage($viData, $enData) as $value)
				<div class="col-sm-4">
					@if($value->sort == 1)
					<div class="about1">
					@else
					<div class="about2">
					@endif
						<h2>{{ $value->name }}</h2>
						<!-- <h3> -->
							{{-- $value->name_shadow --}}
						<!-- </h3> -->
						@if($value->sort == 1)
							@foreach(AboutUs::where('type_id', $value->id)->orderBy('weight', 'asc')->get() as $valueAbout)
								@if($valueAbout->image_url)
									<img src="{{ url(UPLOADIMG . UPLOAD_ABOUT .'/'. Common::getIdVi($valueAbout->id, 'AboutUs') . '/' . Common::objectLanguage('AboutUs', $valueAbout->id, 'vi')->image_url) }}" alt="" />
								@endif
								<!-- <strong> -->
									{{-- $valueAbout->title --}}
								<!-- </strong> -->
								{{ $valueAbout->description }}
							@endforeach
						@else
							<table border="0">
								@foreach(AboutUs::where('type_id', $value->id)->orderBy('weight', 'asc')->get() as $valueAbout)
									<tr>
									<td class="about2-1">{{ $valueAbout->title }}-</td>
									<td class="about2-2">{{ $valueAbout->description }}</td>
									</tr>
								@endforeach
							 </table>
						@endif
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>
@stop