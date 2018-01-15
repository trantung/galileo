@extends('admin.layout.default')

@section('css_header')
@parent
{{--  --}}
@stop

@section('title')
Danh sách lớp học
@stop
@section('content')

<table class="table table-bordered table-responsive">
    <thead>
        <tr class="bg-primary">
            <th width="50px" class="text-center">STT</th>
            <th>Tên lớp</th>
            <th>Câu hỏi/đáp án</th>
            <th>mã code</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($documents as $key => $class)
            <?php $countSubject = 2; ?>
                <tr class="bg-warning">
                    <td rowspan="{{ $countSubject }}" class="text-center"><strong>{{ $key+1 }}</strong></td>
                    <td rowspan="{{ $countSubject }}">{{ $class->name }}</td>
                    <td>
                        {{ $class->type_id }}
                    </td>
                    <td>
                        {{ $class->code }}
                    </td>
                    <td rowspan="{{ $countSubject }}"><a href="{{ action('DocumentController@edit', $class->id) }}" class="btn btn-primary">Sửa</a>
                        {{ Form::open(array('method'=>'DELETE', 'action' => array('DocumentController@destroy', $class->id), 'style' => 'display: inline-block;')) }}
                            <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
                            </td>
                        {{ Form::close() }}
                    </td>
                </tr>
            @if( $countSubject > 1 )
                @for ($i = 1; $i < $countSubject; $i++)
                    <tr class="bg-warning">
                        <td>test</td>
                        <td>test</td>
                    </tr>
                @endfor
            @endif
        @endforeach
    </tbody>
</table>
@stop