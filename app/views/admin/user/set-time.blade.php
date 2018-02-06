@extends('admin.layout.default')

@section('js_header')
@parent
{{ HTML::style('jquery-timepicker/lib/bootstrap-datepicker.css') }}
{{ HTML::style('jquery-timepicker/lib/site.css') }}
{{ HTML::style('jquery-timepicker/jquery.timepicker.css') }} 

{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}

{{ HTML::script(asset('jquery-timepicker/jquery.timepicker.js')) }}
{{ HTML::script(asset('jquery-timepicker/lib/site.js')) }}
{{ HTML::script(asset('jquery-timepicker/lib/bootstrap-datepicker.js')) }}



@stop

@section('title')
Tạo lịch cố vấn học tập
@stop

@section('content')
{{ Form::open(['action' => ['ManagerUserController@postSetTime', $id], 'class' => 'user-set-time-form user-form padding0']) }}

    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">

          <fieldset class="form-group col-sm-4 ">
            <div class="well well-sm">
              <legend>Thứ 2</legend>
              @foreach($data2 as $key2=>$value2)
                <div id="time_start" class="inline-block">
                  <label>Bắt đầu:</label>
                  {{ Form::text('start_time_old[2]['.$key2.']', $value2->start_time, array('class' => 'time start' )) }}                       
                  <label>Kết thúc:</label>
                  {{ Form::text('end_time_old[2]['.$key2.']', $value2->end_time, array('class' => 'time end')) }}
                  <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>                
                </div>  <!-- thứ 2     -->          
              @endforeach
              <hr>
                <div id="time_start" class="inline-block">
                  <label>Bắt đầu:</label>
                  {{ Form::text('start_time_new[2][]', null, array('class' => 'time start')) }}                       
                    <label>Kết thúc:</label>
                  {{ Form::text('end_time_new[2][]', null, array('class' => 'time end')) }}
                </div>
            </div>
            <div class="well well-sm">
              <legend>Thứ 5</legend>
              @foreach($data5 as $key=>$value)
                <div id="time_start" class="inline-block">
                  <label>Bắt đầu:</label>
                  {{ Form::text('start_time_old[5]['.$key.']', $value->start_time, array('class' => 'time start' )) }}                       
                  <label>Kết thúc:</label>
                  {{ Form::text('end_time_old[5]['.$key.']', $value->end_time, array('class' => 'time end')) }}
                  <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> 
                </div>                
              @endforeach
              <hr>
                <div id="time_start" class="inline-block clear-">
                  <label>Bắt đầu:</label>
                  {{ Form::text('start_time_new[5][]', null, array('class' => 'time start')) }}                       
                    <label>Kết thúc:</label>
                  {{ Form::text('end_time_new[5][]', null, array('class' => 'time end')) }}
                </div>
            </div><!--thu 5-->

            <div class="well well-sm">
              <legend>chủ nhật</legend>
              @foreach($data8 as $key=>$value)
                <div id="time_start" class="inline-block">
                  <label>Bắt đầu:</label>
                  {{ Form::text('start_time_old[8]['.$key.']', $value->start_time, array('class' => 'time start' )) }}                       
                  <label>Kết thúc:</label>
                  {{ Form::text('end_time_old[8]['.$key.']', $value->end_time, array('class' => 'time end')) }}
                  <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> 
                </div>                
              @endforeach
              <hr>
                <div id="time_start" class="inline-block">
                  <label>Bắt đầu:</label>
                  {{ Form::text('start_time_new[8][]', null, array('class' => 'time start')) }}                       
                    <label>Kết thúc:</label>
                  {{ Form::text('end_time_new[8][]', null, array('class' => 'time end')) }}
                </div>
            </div>
          </fieldset>
          <fieldset class="form-group col-sm-4 ">
            <div class="well well-sm">
              <legend>Thứ 3</legend>
              @foreach($data3 as $key=>$value)
                <div id="time_start" class="inline-block">
                  <label>Bắt đầu:</label>
                  {{ Form::text('start_time_old[3]['.$key.']', $value->start_time, array('class' => 'time start' )) }}                       
                  <label>Kết thúc:</label>
                  {{ Form::text('end_time_old[3]['.$key.']', $value->end_time, array('class' => 'time end')) }}
                  <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> 
                </div>                
              @endforeach
              <hr>
                <div id="time_start" class="inline-block">
                  <label>Bắt đầu:</label>
                  {{ Form::text('start_time_new[3][]', null, array('class' => 'time start')) }}                       
                    <label>Kết thúc:</label>
                  {{ Form::text('end_time_new[3][]', null, array('class' => 'time end')) }}
                </div>
            </div>
             <div class="well well-sm">
              <legend>Thứ 6</legend>
              @foreach($data6 as $key=>$value)
                <div id="time_start" class="inline-block">
                  <label>Bắt đầu:</label>
                  {{ Form::text('start_time_old[6]['.$key.']', $value->start_time, array('class' => 'time start' )) }}                       
                  <label>Kết thúc:</label>
                  {{ Form::text('end_time_old[6]['.$key.']', $value->end_time, array('class' => 'time end')) }}
                  <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> 
                </div>                
              @endforeach
              <hr>
                <div id="time_start" class="inline-block">
                  <label>Bắt đầu:</label>
                  {{ Form::text('start_time_new[6][]', null, array('class' => 'time start')) }}                       
                    <label>Kết thúc:</label>
                  {{ Form::text('end_time_new[6][]', null, array('class' => 'time end')) }}
                </div>
            </div>
          </fieldset>

          <fieldset class="form-group col-sm-4">
            <div class="well well-sm">
              <legend>Thứ 4</legend>
              @foreach($data4 as $key=>$value)
                <div id="time_start" class="inline-block">
                  <label>Bắt đầu:</label>
                  {{ Form::text('start_time_old[4]['.$key.']', $value->start_time, array('class' => 'time start' )) }}                       
                  <label>Kết thúc:</label>
                  {{ Form::text('end_time_old[4]['.$key.']', $value->end_time, array('class' => 'time end')) }}
                  <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> 
                </div>                
              @endforeach
              <hr>
                <div id="time_start" class="inline-block">
                  <label>Bắt đầu:</label>
                  {{ Form::text('start_time_new[4][]', null, array('class' => 'time start')) }}                       
                    <label>Kết thúc:</label>
                  {{ Form::text('end_time_new[4][]', null, array('class' => 'time end')) }}
                </div>
            </div>
            <div class="well well-sm">
              <legend>thứ 7</legend>
              @foreach($data7 as $key=>$value)
                <div id="time_start" class="inline-block">
                  <label>Bắt đầu:</label>
                  {{ Form::text('start_time_old[7]['.$key.']', $value->start_time, array('class' => 'time start' )) }}                       
                  <label>Kết thúc:</label>
                  {{ Form::text('end_time_old[7]['.$key.']', $value->end_time, array('class' => 'time end')) }}
                  <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> 
                </div>                
              @endforeach
              <hr>
                <div id="time_start" class="inline-block">
                  <label>Bắt đầu:</label>
                  {{ Form::text('start_time_new[7][]', null, array('class' => 'time start')) }}                       
                    <label>Kết thúc:</label>
                  {{ Form::text('end_time_new[7][]', null, array('class' => 'time end')) }}
                </div>
            </div>
          </fieldset>
        </div>

        <div class="clear clearfix"></div>
        {{ Form::submit('Lưu', ['class'=>'btn btn-primary']) }}
      </div>
    </div>
{{ Form::close() }}
<div class="clear clearfix"></div>
  <!-- time picker -->

    <script type="text/javascript" src="{{ asset('jquery-timepicker/datepair.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jquery-timepicker/jquery.datepair.js') }}"></script>
    <script>
    $('#time_start .time ' ).timepicker({
        'minTime': '6:00am',
        'maxTime': '11:30pm',
        'showDuration': true,
        'timeFormat': 'g:ia'

    });
  
    $('#time_start').datepair();

    </script>

@stop