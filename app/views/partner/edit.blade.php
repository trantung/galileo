{{ Form::open(array('action' => array('PartnerController@update', $partner->id), 'method'=>"PUT")) }}

  {{ Form::label('partner_name', 'Ten Partner') }}
  {{ Form::text("partner_name", $partner->partner_name) }}

  {{ Form::submit("Save") }}

{{ Form::close() }}