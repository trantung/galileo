@extends('site.layout.default')

@section('title')
	{{ $title = trans('captions.contact'); }}
@stop

@section('content')

<div class="main about">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="about1">
					<h2>{{ trans('captions.aboutus') }}</h2>
					<h3>{{ trans('captions.aboutus2') }}</h3>
					<img src="{{ url('/assets/images/game5.png') }}" alt="" />
					<strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit</strong>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit
					</p>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="about2">
					<h2>{{ trans('captions.ourhistory') }}</h2>
					<h3>{{ trans('captions.ourhistory2') }}</h3>
					<table>
						<tr>
							<td class="about2-1">2004-</td>
							<td class="about2-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, Lorem ipsum dolor sit amet</td>
						</tr>
						<tr>
							<td class="about2-1">2004-</td>
							<td class="about2-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, Lorem ipsum dolor sit amet</td>
						</tr>
						<tr>
							<td class="about2-1">2004-</td>
							<td class="about2-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, Lorem ipsum dolor sit amet</td>
						</tr>
						<tr>
							<td class="about2-1">2004-</td>
							<td class="about2-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, Lorem ipsum dolor sit amet</td>
						</tr>
						<tr>
							<td class="about2-1">2004-</td>
							<td class="about2-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, Lorem ipsum dolor sit amet</td>
						</tr>
						
					</table>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="about3">
					<h2>{{ trans('captions.orientations') }}</h2>
					<h3>{{ trans('captions.orientations2') }}</h3>

				</div>
			</div>
		</div>
	</div>
</div>
@stop