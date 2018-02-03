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
                <fieldset class="form-group col-sm-4">
                    <div class="well well-sm">
                        <legend>Thứ 2</legend>
                        @foreach($data2 as $key=>$value)
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            {{ Form::text('start_time_old[2]['.$key.']', $value->start_time, array('class' => 'inline-block' )) }}
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            {{ Form::text('end_time_old[2]['.$key.']', $value->end_time, array('class' => 'inline-block')) }}
                        </div>  
                        @endforeach
                        <hr>
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            {{ Form::text('start_time_new[2][]', null, array('class' => 'inline-block')) }}
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            {{ Form::text('end_time_new[2][]', null, array('class' => 'inline-block')) }}
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="form-group col-sm-4">
                    <div class="well well-sm">
                        <legend>Thứ 3</legend>
                        @foreach($data3 as $key=>$value)
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            {{ Form::text('start_time_old[3]['.$key.']', $value->start_time, array('class' => 'inline-block')) }}
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            {{ Form::text('end_time_old[3]['.$key.']', $value->end_time, array('class' => 'inline-block')) }}
                        </div>  
                        @endforeach
                        <hr>
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            {{ Form::text('start_time_new[3][]', null, array('class' => 'inline-block')) }}
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            {{ Form::text('end_time_new[3][]', null, array('class' => 'inline-block')) }}
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="form-group col-sm-4">
                    <div class="well well-sm">
                        <legend>Thứ 4</legend>
                        @foreach($data4 as $key=>$value)
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            {{ Form::text('start_time_old[4]['.$key.']', $value->start_time, array('class' => 'inline-block')) }}
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            {{ Form::text('end_time_old[4]['.$key.']', $value->end_time, array('class' => 'inline-block')) }}
                        </div>  
                        @endforeach
                        <hr>
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            {{ Form::text('start_time_new[4][]', null, array('class' => 'inline-block')) }}
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            {{ Form::text('end_time_new[4][]', null, array('class' => 'inline-block')) }}
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="form-group col-sm-4">
                    <div class="well well-sm">
                        <legend>Thứ 5</legend>
                        @foreach($data5 as $key=>$value)
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            {{ Form::text('start_time_old[5]['.$key.']', $value->start_time, array('class' => 'inline-block')) }}
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            {{ Form::text('end_time_old[5]['.$key.']', $value->end_time, array('class' => 'inline-block')) }}
                        </div>  
                        @endforeach
                        <hr>
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            {{ Form::text('start_time_new[5][]', null, array('class' => 'inline-block')) }}
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            {{ Form::text('end_time_new[5][]', null, array('class' => 'inline-block')) }}
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="form-group col-sm-4">
                    <div class="well well-sm">
                        <legend>Thứ 6</legend>
                        @foreach($data6 as $key=>$value)
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            {{ Form::text('start_time_old[6]['.$key.']', $value->start_time, array('class' => 'inline-block')) }}
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            {{ Form::text('end_time_old[6]['.$key.']', $value->end_time, array('class' => 'inline-block')) }}
                        </div>  
                        @endforeach
                        <hr>
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            {{ Form::text('start_time_new[6][]', null, array('class' => 'inline-block')) }}
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            {{ Form::text('end_time_new[6][]', null, array('class' => 'inline-block')) }}
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="form-group col-sm-4">
                    <div class="well well-sm">
                        <legend>Thứ 7</legend>
                        @foreach($data7 as $key=>$value)
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            {{ Form::text('start_time_old[7]['.$key.']', $value->start_time, array('class' => 'inline-block')) }}
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            {{ Form::text('end_time_old[7]['.$key.']', $value->end_time, array('class' => 'inline-block')) }}
                        </div>  
                        @endforeach
                        <hr>
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            {{ Form::text('start_time_new[7][]', null, array('class' => 'inline-block')) }}
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            {{ Form::text('end_time_new[7][]', null, array('class' => 'inline-block')) }}
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="form-group col-sm-4">
                    <div class="well well-sm">
                        <legend>Chủ nhật</legend>
                        @foreach($data8 as $key=>$value)
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            {{ Form::text('start_time_old[8]['.$key.']', $value->start_time, array('class' => 'inline-block')) }}
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            {{ Form::text('end_time_old[8]['.$key.']', $value->end_time, array('class' => 'inline-block')) }}
                        </div>  
                        @endforeach
                        <hr>
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            {{ Form::text('start_time_new[8][]', null, array('class' => 'inline-block')) }}
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            {{ Form::text('end_time_new[8][]', null, array('class' => 'inline-block')) }}
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
@stop