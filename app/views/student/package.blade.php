<div class="form-group well well-sm">
    <fieldset>  
        <legend>Thông tin gói học</legend>
        <div class="form-group">
            <label>trung tâm</label>
            {{ Form::select('center_id',['' => '--chọn--']+$center, null , ['class' => 'form-control ', 'required' => true]) }}
        </div>
        <div class="form-group">
            <label>chọn học sinh</label>
            {{ Form::select('student_id',['' => '--chọn--']+$student, null , ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'required' => true]) }}
        </div>

        <div class="box alert filter-document-form">
            <div class="input-group inline-block">
            <label style="display: block;">Lớp</label>
            {{ Form::select('class_id', ['' => '--Tất cả--'] + Common::getClassList(), Input::get('class_id'), ['class' => 'form-control select-class', 'required' => true]) }}
            </div>

            <div class="input-group inline-block">
            <label style="display: block;">Môn học</label>
            {{ Form::select('subject_id', ['' => '--Tất cả--'] + Common::getSubjectList(), Input::get('subject_id'), ['class' => 'form-control select-subject', 'required' => true]) }}
            </div>

            <div class="input-group inline-block select-level-from-class-subject">
                <label style="display: block;">Trình độ</label>
                 {{ Common::getLevelDropdownList('level_id', Input::get('level_id')) }}
            </div>
        
        </div>
        <div class="form-group">
            {{ Form::label('package_id','Gói học') }} 
            {{ Common::getPackageDropdownList('package_id', $package, null) }}
        </div>
        <legend>thời gian học</legend>
        <div class="form-group time-box-student">
            <div class="item form-group" order="1">
                <div class="input-group inline-block col-sm-4" >
                    <label>Chọn ngày học</label>
                    <input type="date" class="lesson_date form-control" required placeholder="Ngày vào học" name="time_id[]">
                </div>
                <div class="input-group inline-block col-sm-4" >
                    <label>giờ băt đầu học</label>
                    {{ Form::text('hours[]', '', ['class' => 'form-control timepicker lesson_hour', 'required'=>true ]) }}
                </div>
            </div>
            <div class="item form-group hidden" order="2">
                <div class="input-group inline-block col-sm-4" >
                    <label>Chọn ngày học</label>
                    <input type="date" class="lesson_date form-control" placeholder="Ngày vào học" name="time_id[]">
                </div>
                <div class="input-group inline-block col-sm-4" >
                    <label>giờ băt đầu học</label>
                    {{ Form::text('hours[]', '', ['class' => 'form-control timepicker lesson_hour']) }}
                </div>
            </div>
            <div class="item form-group hidden" order="3">
                <div class="input-group inline-block col-sm-4" >
                    <label>Chọn ngày học</label>
                    <input type="date" class="lesson_date form-control" placeholder="Ngày vào học" name="time_id[]">
                </div>
                <div class="input-group inline-block col-sm-4" >
                    <label>giờ băt đầu học</label>
                    {{ Form::text('hours[]', '', ['class' => 'form-control timepicker lesson_hour']) }}
                </div>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('lesson_code', 'Bắt đầu học từ buổi', ['style' => 'display: block']) }}
            {{ Form::select('lesson_code', Common::getListLessonCode(), null,['class' => 'form-control', 'required'=>true])}}
        </div>
        <div class="form-group">
            {{ Form::label('money_paid', 'Số tiền đóng học') }} 
            {{ Form::text('money_paid','', ['class' => 'form-control','required'=>true])}}
        </div>
        <div class="form-group">
            {{ Form::label('user_id','chọn cố vấn học tập') }}
            {{ Form::select('user_id', ['' => '-- chọn --'] + $userActive, null,['class' => 'form-control selectpicker select-teacher', 'data-live-search' => 'true'])}}
        </div>
    </fieldset>
</div>