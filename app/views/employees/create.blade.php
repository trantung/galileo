
{{ Form::open(array('action' => array('EmployeesController@store'), 'method'=>"POST")) }}

  {{ Form::label('center_name', 'Ten Center') }}

  {{ Form::select('center_id', $center, null) }}

  {{ Form::label('employees_name', 'Ten Employees') }}
  {{ Form::text("employees_name" ) }}

  {{ Form::submit("Add employees") }}

{{ Form::close() }}