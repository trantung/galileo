@extends('admin.layout.default')

@section('css_header')
@parent
{{--  --}}
@stop

@section('title')
Danh sách học liệu
@stop
@section('content')

<table class="table table-bordered table-responsive">
    <thead>
        <tr class="bg-primary">
            <th width="50px" class="text-center">STT</th>
            <th>Tên học liệu</th>
            <th>Loại học liệu</th>
            <th>Mã phiếu</th>
            <th>Lớp</th>
            <th>Môn</th>
            <th>Trình độ</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($documents as $key => $document)
            <?php 
                $countSubject = 2;
            ?>
                <tr class="bg-warning">
                    <td rowspan="{{ $countSubject }}" class="text-center"><strong>{{ $key+1 }}</strong></td>
                    @if($document->type_id == P)
                    <?php 
                        $documentP = Common::getDocument($document, P);
                        
                    ?>
                        <td>{{ Common::getObject($documentP, 'name') }}</td>
                        <td>
                            {{ getNameTypeId(Common::getObject($documentP, 'type_id')) }}
                        </td>
                        <td>
                            {{ Common::getObject($documentP, 'code') }}
                        </td>
                        <td>
                            {{ getClassByDocument($document) }}
                        </td>
                        <td>
                            {{ getSubjectByDocument($document) }}
                        </td>
                        <td>
                            {{ getLevelByDocument($document) }}
                        </td>
                    @else
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @endif
                    <td rowspan="{{ $countSubject }}">
                        {{ renderUrlByPermission('DocumentController@edit', 'Sửa', $document->parent_id, ['class'=>"btn btn-primary"]) }}
                        @if(checkPermissionForm('DocumentController@destroy', 'Xoá', $document->parent_id))
                        {{ Form::open(array('method'=>'DELETE', 'action' => array('DocumentController@destroy', $document->parent_id), 'style' => 'display: inline-block;')) }}
                            <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
                            </td>
                        {{ Form::close() }}
                        @endif
                    </td>
                </tr>
            @if( $countSubject > 1 )
                @for ($i = 1; $i < $countSubject; $i++)
                    <tr class="bg-warning">
                    <?php 
                        $documentD = Common::getDocument($document, D);
                    ?>
                        @if($documentD)
                        <td>{{ Common::getObject($documentD, 'name') }}</td>
                        <td>
                            {{ getNameTypeId(Common::getObject($documentD, 'type_id')) }}
                        </td>
                        <td>
                            {{ Common::getObject($documentD, 'code') }}
                        </td>
                        @else
                        <td></td>
                        <td></td>
                        <td></td>
                        @endif
                        <td>
                            {{ getClassByDocument($document) }}
                        </td>
                        <td>
                            {{ getSubjectByDocument($document) }}
                        </td>
                        <td>
                            {{ getLevelByDocument($document) }}
                        </td>
                    </tr>
                @endfor
            @endif
        @endforeach
    </tbody>
</table>
@stop