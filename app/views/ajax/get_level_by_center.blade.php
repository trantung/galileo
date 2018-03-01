<?php $rand = rand(0,99999); ?>
<div class="collapse-level">
    <a role="button" data-toggle="collapse" href="#collapse-center-{{ time().$rand }}" aria-expanded="false" aria-controls="collapse-center-{{ time().$rand }}">Trình độ chuyên môn <i class="fa fa-angle-down"></i></a>
    {{-- <div class="collapse" id="collapse-center-{{ time().$rand }}"> --}}
        <ul class="list-class-in-center nav collapse" id="collapse-center-{{ time().$rand }}">
            @if( count($listClasses) )
                @foreach( $listClasses as $key => $_class )
                    <li class="form-group item class-item checkbox">
                        <label for="class-{{ $key.$rand }}" href="#classCollapse-{{ $key.$rand }}">
                            {{ Form::checkbox('', $_class->id, false, ['id'=>'class-'.$key.$rand]) . $_class->name }}  (<a href="#" class="select-all">Chọn hết</a>)
                        </label>
                        <ul class="collapse subject" id="classCollapse-{{ $key.$rand }}">
                            @foreach( $_class->subjects as $keyS => $_subject )
                                @if( in_array($_subject->id, $listSubjects) )
                                    <li class="form-group item subject-item checkbox">
                                        <label for="subject-{{ $key.$keyS.$rand }}" href="#subjectCollapse-{{ $key.$keyS.$rand }}">
                                            {{ Form::checkbox('', $_subject->id, false, ['id'=>'subject-'.$key.$keyS.$rand]).$_subject->name }} (<a href="#" class="select-all">Chọn hết</a>)
                                        </label>
                                        <ul class="collapse level" id="subjectCollapse-{{ $key.$keyS.$rand }}">
                                            @foreach( Common::getLevelBySubject($_class->id, $_subject->id) as $_level )
                                                @if( in_array($_level->id, $listLevels) )
                                                    <li class="form-group item level-item checkbox">
                                                        <label for="level-{{ $_level->id.$rand }}">
                                                            {{ Form::checkbox('level'.( isset($centerId) ? "[$centerId]" : '' ).'['.$_level->id.']', $_level->id, ( isset($levelData) && in_array($_level->id, $levelData) ), ['id'=>'level-'.$_level->id.$rand]).$_level->name }}
                                                        </label>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            @else
            <a href="{{ action('ClassController@create') }}">Tạo mới môn học</a>
            @endif
        </ul>
    {{-- </div> --}}
</div>