@extends('admin.layout.default')

@section('js_header')
@parent
{{ HTML::script('adminlte/dist/js/app.min.js') }}
@stop

@section('title')
Danh sách học liệu
@stop

@section('content')

@include('admin.document.filter')
@if( count($documents) )
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
                    $documentP = Common::getDocument($document, P);
                    $documentD = Common::getDocument($document, D);
                ?>
                <tr class="bg-warning">
                    <td rowspan="2" class="text-center"><strong>{{ $key+1 }}</strong></td>
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
                    <td rowspan="2"><a href="{{ action('DocumentController@edit', $document->parent_id) }}" class="btn btn-primary">Sửa</a>
                        {{ Form::open(array('method'=>'DELETE', 'action' => array('DocumentController@destroy', $document->parent_id), 'style' => 'display: inline-block;')) }}
                            <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
                            </td>
                        {{ Form::close() }}
                    </td>
                </tr>
                <tr class="bg-warning">
                    <td>{{ Common::getObject($documentD, 'name') }}</td>
                    <td>
                        {{ getNameTypeId(Common::getObject($documentD, 'type_id')) }}
                    </td>
                    <td>
                        {{ Common::getObject($documentD, 'code') }}
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
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="alert alert-warning">Không tìm thấy dữ liệu!</div>
@endif
@stop
