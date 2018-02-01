
{{ Form::open(array('action' => array('CenterController@store'), 'method'=>"POST")) }}

  {{ Form::label('partner_name', 'Ten Partner') }}

  {{ Form::select('partner_id', $partner, null) }}

  {{ Form::label('center_name', 'Ten Center') }}
  {{ Form::text("center_name" ) }}

  {{ Form::submit("Add center") }}

{{ Form::close() }}