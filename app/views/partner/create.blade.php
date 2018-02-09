
{{ Form::open(array('action' => array('PartnerController@store'), 'method'=>"POST")) }}

  {{ Form::label('partner_name', 'Ten Partner') }}
  {{ Form::text("partner_name") }}

  {{ Form::submit("Add partner") }}

{{ Form::close() }}