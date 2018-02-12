<div class="form-group well well-sm">
    <fieldset>
        <legend>Thông tin gói học</legend>
        <div class="box alert filter-document-form">
            <div class="input-group inline-block">
            <label style="display: block;">Lớp</label>
            {{ Form::select('class_id', ['' => '--Tất cả--'] + $class, Input::get('class_id'), ['class' => 'form-control select-class']) }}
            </div>
            <div class="input-group inline-block">
            <label style="display: block;">Môn học</label>
            {{ Form::select('subject_id', ['' => '--Tất cả--'] + $subject, Input::get('subject_id'), ['class' => 'form-control select-subject']) }}
            </div>
            <div class="input-group inline-block select-level-from-class-subject">
                <label style="display: block;">Trình độ</label>
                 {{ Common::getLevelDropdownList('level_id', Input::get('level_id')) }}
            </div>
        
        </div>
        <div class="form-group">
            {{ Form::label('package_id','Gói học') }} 
            {{ Form::select('package_id', $package, null, ['class' => 'form-control', 'requited'=>true]) }}
        </div>
        <div class="form-group">
            {{ Form::label('lesson_code', 'Bắt đầu học từ buổi', ['style' => 'display: block']) }}
            {{ Form::select('lesson_code', Common::getListLessonCode(), null,['class' => 'form-control', 'requited'=>true])}}
        </div>
        <div class="form-group">
            {{ Form::label('money_paid', 'Số tiền đóng học') }} 
            {{ Form::text('money_paid','', ['class' => 'form-control','requited'=>true])}}
        </div>
        <div class="form-group">
            {{ Form::label('user_id','chọn cố vấn học tập') }}
            {{ Form::select('user_id', ['' => '-- chọn --'] + $userActive, null,['class' => 'form-control'])}}
        </div>
        <legend> thời gian học</legend>
        <div class="input-group inline-block  col-sm-4" >
            <label for="time_id">Chọn ngày học</label>
            <input type="date" class="form-control" id="date_study" placeholder="Ngày vào học" name="time_id">
        </div>
       
        <div class="input-group inline-block col-sm-4" >
            <label for="hours">giờ băt đầu học</label>
            {{ Form::text('hours', null, ['class' => 'form-control timepicker', 'requited'=>true ]) }}
        </div>
    </fieldset> 
    <div class="input-group inline-block">
        <label for="dad_phone">Manual CVHT</label>
        {{ Form::text('manual_user', null, array('class' => 'form-control', 'id' => 'tags')) }}
    </div>
         
</div>