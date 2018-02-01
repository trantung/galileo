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
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            <input class="inline-block" type="time" name="time[{{ T2 }}][0][start]" value="" placeholder="" min="6:00" max="21:00">
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            <input class="inline-block" type="time" name="time[{{ T2 }}][0][end]" value="" placeholder="" min="6:00" max="21:00">
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="form-group col-sm-4">
                    <div class="well well-sm">
                        <legend>Thứ 3</legend>
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            <input class="inline-block" type="time" name="time[{{ T3 }}][0][start]" value="" placeholder="" min="6:00" max="21:00">
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            <input class="inline-block" type="time" name="time[{{ T3 }}][0][end]" value="" placeholder="" min="6:00" max="21:00">
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="form-group col-sm-4">
                    <div class="well well-sm">
                        <legend>Thứ 4</legend>
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            <input class="inline-block" type="time" name="time[{{ T4 }}][0][start]" value="" placeholder="" min="6:00" max="21:00">
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            <input class="inline-block" type="time" name="time[{{ T4 }}][0][end]" value="" placeholder="" min="6:00" max="21:00">
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="form-group col-sm-4">
                    <div class="well well-sm">
                        <legend>Thứ 5</legend>
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            <input class="inline-block" type="time" name="time[{{ T5 }}][0][start]" value="" placeholder="" min="6:00" max="21:00">
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            <input class="inline-block" type="time" name="time[{{ T5 }}][0][end]" value="" placeholder="" min="6:00" max="21:00">
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="form-group col-sm-4">
                    <div class="well well-sm">
                        <legend>Thứ 6</legend>
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            <input class="inline-block" type="time" name="time[{{ T6 }}][0][start]" value="" placeholder="" min="6:00" max="21:00">
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            <input class="inline-block" type="time" name="time[{{ T6 }}][0][end]" value="" placeholder="" min="6:00" max="21:00">
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="form-group col-sm-4">
                    <div class="well well-sm">
                        <legend>Thứ 7</legend>
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            <input class="inline-block" type="time" name="time[{{ T7 }}][0][start]" value="" placeholder="" min="6:00" max="21:00">
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            <input class="inline-block" type="time" name="time[{{ T7 }}][0][end]" value="" placeholder="" min="6:00" max="21:00">
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="form-group col-sm-4">
                    <div class="well well-sm">
                        <legend>Chủ nhật</legend>
                        <div class="inline-block">
                            <label>Bắt đầu:</label>
                            <input class="inline-block" type="time" name="time[{{ CN }}][0][start]" value="" placeholder="" min="6:00" max="21:00">
                        </div>
                        <div class="inline-block">
                            <label>Kết thúc:</label>
                            <input class="inline-block" type="time" name="time[{{ CN }}][0][end]" value="" placeholder="" min="6:00" max="21:00">
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