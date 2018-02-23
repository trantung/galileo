@extends('admin.layout.default')

@section('js_header')
@parent
  {{ HTML::script( asset('custom/js/form-control.js') ) }}
  {{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop
@section('title')
  Tạo lịch cố vấn học tập
@stop
@section('content')
{{ Form::open(['action' => ['ManagerUserController@postSetTime', $id], 'class' => 'user-set-time-form user-form padding0']) }}
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                @for( $i = 2; $i <= 8; $i++ )
                    <fieldset class="form-group col-sm-4">
                        <div class="well well-sm col-sm-12">
                            <legend>{{ ($i == 8) ? 'Chủ nhật' : 'Thứ '.$i }}</legend>
                            @for( $j = 0; $j < 8 ; $j++ )
                                <div class="item new">
                                    <div class="form-group col-sm-6">
                                        <label>Bắt đầu:</label>
                                        {{ Form::text('start_time['. $i .'][]', (!empty($data[$i][$j]['start_time']) ? $data[$i][$j]['start_time'] : ''), array('class' => 'form-control inline-block timepicker', 'style' => 'width: 60px')) }}
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Kết thúc:</label>
                                        {{ Form::text('end_time['. $i .'][]', (!empty($data[$i][$j]['end_time']) ? $data[$i][$j]['end_time'] : ''), array('class' => 'form-control inline-block timepicker', 'style' => 'width: 60px')) }}
                                    </div>
                                </div>
                                <div class="clear clearfix"></div>
                            @endfor
                        </div>
                    </fieldset>
                @endfor
            </div>

          <div class="clear clearfix"></div>
          {{ Form::submit('Lưu', ['class'=>'btn btn-primary']) }}
        </div>
    </div>
{{ Form::close() }}
<div class="clear clearfix"></div>
@stop