{{-- {{ dd($levelData) }} --}}
<ul class="list-class-in-center nav">
    @if( count($listClasses) )
        @foreach( $listClasses as $key => $_class )
            <li class="form-group item class-item checkbox">
                <label for="class-{{ $key }}" href="#classCollapse-{{ $key }}">
                    {{ Form::checkbox('', $_class->id, false, ['id'=>'class-'.$key]).$_class->name }}
                </label>
                <ul class="collapse subject" id="classCollapse-{{ $key }}">
                    @foreach( $_class->subjects as $keyS => $_subject )
                        @if( in_array($_subject->id, $listSubjects) )
                            <li class="form-group item subject-item checkbox">
                                <label for="subject-{{ $key.$keyS }}" href="#subjectCollapse-{{ $key.$keyS }}">
                                    {{ Form::checkbox('', $_subject->id, false, ['id'=>'subject-'.$key.$keyS]).$_subject->name }} (<a href="#">Chọn hết</a>)
                                </label>
                                <ul class="collapse level" id="subjectCollapse-{{ $key.$keyS }}">
                                    @foreach( Common::getLevelBySubject($_class->id, $_subject->id) as $_level )
                                        @if( in_array($_level->id, $listLevels) )
                                            <li class="form-group item level-item checkbox">
                                                <label for="level-{{ $_level->id }}" href="#subjectCollapse-{{ $_level->id }}">
                                                    {{ Form::checkbox('level['.$_level->id.']', $_level->id, ( isset($levelData) && in_array($_level->id, $levelData) ), ['id'=>'level-'.$_level->id]).$_level->name }}
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