
{{ Form::open(array('action' => array('CenterController@update', $center->id), 'method'=>"PUT")) }}

  {{ Form::label('partner_name', 'Ten Partner') }}
  {{ Form::select("partner_name", $partner) }}

  {{ Form::label('center_name', 'Ten Center') }}
  {{ Form::text("center_name", $center_name)}}

  {{ Form::submit("Save") }}

{{ Form::close() }}