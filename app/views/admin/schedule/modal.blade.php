<div class="modal fade" id="myModal-{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {{ Form::open(['action' => ['ScheduleController@update', $value->id], 'method' => "PUT" ]) }}

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
              {{ Form::label('user_id','chọn cố vấn học tập') }}
              {{ Form::select('user_id', ['' => '-- chọn --'] + User::where('role_id', CVHT)->lists('username', 'id'), $value->user_id,['class' => 'form-control selectpicker select-teacher', 'data-live-search' => 'true'])}}
          </div>

          <div class="box alert filter-document-form">
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
                 {{ Common::getLevelDropdownList('level_id', $value->level_id) }}
            </div>
        
          </div>
          <div class="form-group">
              {{ Form::label('lesson_code', 'Bắt đầu học từ buổi', ['style' => 'display: block']) }}
              {{ Form::select('lesson_code', Common::getListLessonCode(), $value->lesson_code,['class' => 'form-control', 'required'=>true])}}
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      {{ Form::close() }}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->