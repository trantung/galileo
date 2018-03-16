<div class="modal fade" id="courseModal-{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{ Form::open(['action' => ['ScheduleController@courseEdit', $value->id], 'method' => "PUT" ]) }}

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Sửa khóa học - {{ Common::getObject($value->students, 'fullname' ) }}</h4>
            </div>
            <div class="modal-body">
                <div class="box alert">
                    <p>
                        <b>Lớp: </b>{{ Common::getObject($value->classes, 'name' ) }}
                    </p>
                    <p>
                        <b>Môn học: </b>{{ Common::getObject($value->subjects, 'name' ) }}
                    </p>
                    <p>
                        <b>Trình độ: </b>{{ Common::getObject($value->levels, 'name' ) }}
                    </p><br>
                    <div class="form-group">
                        {{ Form::label('lesson_code', 'Bắt đầu học từ buổi', ['style' => 'display: block']) }}
                        {{ Form::select('lesson_code', Common::getListLessonCode(), $value->lesson_code,['class' => 'form-control', 'required'=>true])}}
                    </div>
                    <fieldset>
                        <legend>Sửa lịch học</legend>
                            @foreach(Common::getScheduleOfStudentPackage($value->id) as $key => $spdetail)
                                <div class="form-group">
                                    <div class="input-group inline-block">
                                        <label>Ngày học</label>
                                        {{ Form::select('time_id['.$key.']['.$spdetail->time_id.']', ['' => '-- Chọn --']+Common::getTimeIdList(), $spdetail->time_id, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="input-group inline-block" style="width: 100px">
                                        <label>Giờ học</label>
                                        {{ Form::text('hours['.$key.']['.$spdetail->lesson_hour.']', $spdetail->lesson_hour, ['class' => 'form-control timepicker lesson_hour', 'required'=>true ]) }}
                                    </div>
                                    <div class="input-group inline-block">
                                        <label>Cố vấn học tập</label>
                                        {{ Form::select('user_id['.$key.']', ['' => '-- chọn --'] + Common::getCVHTList(), $spdetail->user_id,['class' => 'form-control selectpicker select-teacher', 'data-live-search' => 'true'])}}
                                    </div>
                                </div>
                            @endforeach
                    </fieldset>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
            {{ Form::close() }}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->