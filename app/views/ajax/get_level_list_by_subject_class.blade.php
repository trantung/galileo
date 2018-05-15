<?php $rand = str_random(20); ?>
<div class="collapse-level">
    {{-- <div class="collapse" id="collapse-center-{{ $rand }}"> --}}
        <ul class="list-class-in-center nav row">
            @if( count($listSubjects) )
                @foreach( $listSubjects as $key => $_subject )
                    <li class="form-group item class-item checkbox col-sm-6 margin0">
                        <label for="class-{{ $key.$rand }}" href="#classCollapse-{{ $key.$rand }}">
                            {{ Form::checkbox('', $_subject->id, false, ['id'=>'class-'.$key.$rand]) . $_subject->name }}  (<a href="#" class="select-all">Chọn hết</a>)
                        </label>
                        <ul class="collapse subject" id="classCollapse-{{ $key.$rand }}">
                            @foreach( $_subject->classes as $keyS => $_class )
                                {{-- @if( in_array($_class->id, $listSubjects) ) --}}
                                    <li class="form-group item subject-item checkbox">
                                        <label for="subject-{{ $key.$keyS.$rand }}" href="#subjectCollapse-{{ $key.$keyS.$rand }}">
                                            {{ Form::checkbox('', $_class->id, false, ['id'=>'subject-'.$key.$keyS.$rand]).$_class->name }} (<a href="#" class="select-all">Chọn hết</a>)
                                        </label>
                                        <ul class="collapse level" id="subjectCollapse-{{ $key.$keyS.$rand }}">
                                            @foreach( Common::getLevelBySubject($_class->id, $_subject->id) as $_level )
                                                @if( in_array($_level->id, $listLevels) )
                                                    <li class="form-group item level-item checkbox">
                                                        <label for="level-{{ $_level->id.$rand }}">
                                                            {{ Form::checkbox('level['.$_level->id.']', $_level->id, ( isset($levelData) && in_array($_level->id, $levelData) ), ['id'=>'level-'.$_level->id.$rand]).$_level->name }}
                                                        </label>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                {{-- @endif --}}
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