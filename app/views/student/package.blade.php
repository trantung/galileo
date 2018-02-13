<div class="form-group well well-sm">
                    <fieldset>
                        <legend>Thông tin gói học</legend>
                        <div class="box alert filter-document-form">
                            <div class="input-group inline-block">
                            <label style="display: block;">Lớp</label>
                            {{ Form::select('class_id', ['' => '--Tất cả--'] + Common::getClassList(), Input::get('class_id'), ['class' => 'form-control select-class']) }}
                            </div>
                            <div class="input-group inline-block">
                            <label style="display: block;">Môn học</label>
                            {{ Form::select('subject_id', ['' => '--Tất cả--'] + Common::getSubjectList(), Input::get('subject_id'), ['class' => 'form-control select-subject']) }}
                            </div>
                            <div class="input-group inline-block select-level-from-class-subject">
                                <label style="display: block;">Trình độ</label>
                                 {{ Common::getLevelDropdownList('level_id', Input::get('level_id')) }}
                            </div>
                        
                        </div>
                        <div class="form-group">
                            {{ Form::label('package','Gói học') }} 
                            {{ Form::select('package', $package, null, ['class' => 'form-control', 'requited'=>true]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('lesson_code', 'Bắt đầu học từ buổi', ['style' => 'display: block']) }}
                            {{ Form::select('lesson_code', ['' => '--chọn--'] + Common::getListLessonCode(), null,['class' => 'form-control', 'requited'=>true])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('number_manny', 'Số tiền đóng học') }} 
                            {{ Form::text('number_many','', ['class' => 'form-control','requited'=>true])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('','chọn cố vấn học tập') }}
                            {{ Form::select('',['' => '-- chọn --'] + User::where('role_id', CVHT)->lists('username', 'id'), null,['class' => 'form-control'])}}
                        </div>
                            <legend> thời gian học</legend>
                        <div class="input-group inline-block">
                            <label for="date">Chọn thứ</label>
                            {{ Form::select('date', ['--chọn--', T2 => 'thứ 2', T3 => 'thứ 3', T4 => 'thứ 4', T5 => 'thứ 5', T6 => 'thứ 6', T7 => 'thứ 7', CN => 'chủ nhật'], null,['class' => 'form-control', 'requited'=>true])}}
                        </div>
                       
                        <div class="input-group inline-block" style="width: 100px;">
                            <label for="time">giờ băt đầu học</label>
                            {{ Form::text('time', null, ['class' => 'form-control timepicker', 'requited'=>true ]) }}
                        </div>
                    </fieldset> 
                         
                </div>