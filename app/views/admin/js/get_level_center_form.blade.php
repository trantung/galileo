@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop
{{-- {{ dd($listLevels) }} --}}
<ul class="list-class-in-center nav">
    @if( count($listClasses) )
        @foreach( $listClasses as $key => $_class )
            <li class="form-group item class-item checkbox">
                <label for="class-{{ $key }}" href="#classCollapse-{{ $key }}">
                    {{ Form::checkbox('', $_class->id, false, ['id'=>'class-'.$key]) . $_class->name }}
                </label>
                <ul class="collapse subject" id="classCollapse-{{ $key }}">
                    @foreach( $_class->subjects as $keyS => $_subject )
                        <li class="form-group item subject-item checkbox">
                            <label for="subject-{{ $key.$keyS }}" href="#subjectCollapse-{{ $key.$keyS }}">
                                {{ Form::checkbox('', $_subject->id, false, ['id'=>'subject-'.$key.$keyS]).$_subject->name }}
                            </label>
                            <ul class="collapse level" id="subjectCollapse-{{ $key.$keyS }}">
                                @foreach( Common::getLevelBySubject($_class->id, $_subject->id) as $_level )
                                    <li class="form-group item level-item checkbox">
                                        <label for="level-{{ $_level->id }}" href="#subjectCollapse-{{ $_level->id }}">
                                            {{ Form::checkbox('level['.$_level->id.']', $_level->id, isset($listLevels[$_level->id]), ['id'=>'level-'.$_level->id]).$_level->name }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    @else
    <a href="{{ action('ClassController@create') }}">Tạo mới môn học</a>
    @endif
</ul>