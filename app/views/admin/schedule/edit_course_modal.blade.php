<div class="modal fade" id="myModal-{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{ Form::open(['action' => ['ScheduleController@courseEdit', $value->id], 'method' => 'PUT']) }}
                <div class="modal-header">
                    <label class="modal-title" id="exampleModalLabel" style="font-size: 18px">Thông tin gói học</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::hidden('student_id', $value->student_id) }}
                    <div class="form-group ">
                        <div class="input-group inline-block">
                            <label>Trung tâm </label>
                            {{ Form::select('center_id', ['' => '--chọn--'] + Center::lists('name', 'id'), $value->center_id , ['class' => 'form-control ', 'required' => true]) }}
                        </div>
                        <div class="input-group inline-block filter-document-form">
                            <div class="input-group inline-block">
                                <label style="display: block;">Lớp</label>
                                {{ Form::select('class_id', ['' => '--Tất cả--'] + Common::getClassList(), $value->class_id, ['class' => 'form-control select-class', 'required' => true]) }}
                            </div>
                            <div class="input-group inline-block">
                                <label style="display: block;">Môn học</label>
                                {{ Form::select('subject_id', ['' => '--Tất cả--'] + Common::getSubjectList(), $value->subject_id, ['class' => 'form-control select-subject', 'required' => true]) }}
                            </div>
                            <div class="input-group inline-block select-level-from-class-subject">
                                <label style="display: block;">Trình độ</label>
                                {{ Common::getLevelDropdownList('level_id', $value->level_id, $value->class_id, $value->subject_id) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('package_id','Gói học') }}
                        {{ Form::select('package_id', ['' => '--Tất cả--'] + Package::lists('name', 'id'), $value->package_id, ['class' => 'form-control select-subject', 'required' => true]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('money_paid', 'Số tiền đóng học') }} 
                        {{ Form::text('money_paid', $value->money_paid, ['class' => 'form-control','required'=>true])}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('lesson_code', 'Bắt đầu học từ buổi', ['style' => 'display: block']) }}
                        {{ Form::select('lesson_code', Common::getListLessonCode(), $value->lesson_code, ['class' => 'form-control', 'required'=>true])}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            {{  Form::close() }}
        </div>
    </div>  