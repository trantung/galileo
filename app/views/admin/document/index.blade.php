@extends('admin.layout.default')

@section('css_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

@section('title')
    Danh sách học liệu
@stop

@section('content')

@include('admin.document.filter')
<table class="table table-bordered table-responsive">
    <thead>
        <tr class="bg-primary">
            <th width="50px" class="text-center">STT</th>
            <th>Trạng thái</th>
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
                    <?php 
                        $documentP = Common::getDocument($document, P);
                        $documentD = Common::getDocument($document, D);
                    ?>
                    @if($documentP)
                        <td> 
                            <label>{{ getStatusDoc($documentP) }}</label>
                            @if(checkUrlPermission('DocumentController@getCheckDoc'))
                                <input class="re-status pull-right" type="checkbox"  value ="{{ $documentP->id }}" {{Common::checkedCheckbox($documentP)}}>
                            @endif
                        </td>

                        <td>
                            {{ getNameTypeId(Common::getObject($documentP, 'type_id')) }}
                           
                        </td>
                        <td>
                            {{ Common::getObject($documentP, 'code') }}
                            @if(renderUrlByPermission('DocumentController@index', 'index', ''))
                                @if(Common::AskPermission($documentP->id))
                                    @if(Common::checkQuantityDownload($documentP))
                                        <a target="_blank" href="{{ asset($documentP->file_url) }}" class="view_pdf" data-viewid="{{ $documentP->id }}"><i class ="fa fa-eye"></i></a>
                                    @endif
                                    @if(renderUrlByPermission('DocumentController@getPrint', 'print', ''))
                                        @if( Common::getObject($documentP, 'file_url') )
                                            <a type="button" class="btn" onclick="printJS({printable: '{{ Common::getObject($documentP, 'file_url') }}', type:'pdf', showModal:true})"><i class="glyphicon glyphicon-print"></i></a>
                                        @endif
                                    @endif
                                @else
                                    {{ Form::open(array('method'=>'POST', 'action' => array('QuantityDownloadController@postAskPermission', $documentP->id), 'style' => 'display: inline-block;')) }}
                                        <button class="btn btn-danger" onclick="return confirm('Bạn hết lượt view, hãy hỏi quản lý?');">Limit</button>
                                        </td>
                                    {{ Form::close() }}
                                @endif   
                            @endif 
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
                        {{ renderUrlByPermission('DocumentController@edit', '', $document->parent_id, ['class'=>"btn btn-info fa fa-edit"]) }}
                        @if(checkPermissionForm('DocumentController@destroy', 'Xoá', $document->parent_id))
                        {{ Form::open(array('method'=>'DELETE', 'action' => array('DocumentController@destroy', $document->parent_id), 'style' => 'display: inline-block;')) }}
                            <button class="btn btn-danger fa fa-trash" onclick="return confirm('Bạn có chắc chắn muốn xóa?');"> </button>
                    </td>
                        {{ Form::close() }}
                        @endif
                    </td>
                </tr>
            @if( $countSubject > 1 )
                @for ($i = 1; $i < $countSubject; $i++)
                    <tr class="bg-warning">
                        @if($documentD)
                        <td>
                           <label>{{ getStatusDoc($documentD) }}</label>
                            @if(checkUrlPermission('DocumentController@getCheckDoc'))
                            <input class="re-status pull-right" type="checkbox"  value ="{{ $documentD->id }}" {{Common::checkedCheckbox($documentD)}}>
                            @endif
                        </td>
                        <td>
                            {{ getNameTypeId(Common::getObject($documentD, 'type_id')) }}
                        </td>
                        <td>
                            {{ Common::getObject($documentD, 'code') }}
                            @if(renderUrlByPermission('DocumentController@index', 'index', ''))
                                @if(Common::AskPermission($documentD->id))
                                    @if(Common::checkQuantityDownload($documentD))
                                            <a target="_blank" href="{{ asset($documentD->file_url) }} " class="view_pdf" data-viewid="{{ $documentD->id }}"><i class="fa fa-eye"></i></a>
                                    @endif
                                    @if(renderUrlByPermission('DocumentController@getPrint', 'print', ''))
                                        @if( Common::getObject($documentD, 'file_url') )
                                            <a type="button" class="btn" onclick="printJS({printable: '{{ Common::getObject($documentD, 'file_url') }}', type:'pdf', showModal:true})"><i class="glyphicon glyphicon-print"></i></a>
                                        @endif
                                    @endif
                                @else
                                    {{ Form::open(array('method'=>'POST', 'action' => array('QuantityDownloadController@postAskPermission', $documentD->id), 'style' => 'display: inline-block;')) }}
                                        <button class="btn btn-danger" onclick="return confirm('Bạn hết lượt xem, chờ quản trị phê duyệt?');">Limit</button>
                                        </td>
                                    {{ Form::close() }}
                                @endif
                            @endif
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

<div class="row">
    <div class="col-xs-12">
        {{ $documents->appends(Request::except('page'))->links() }}
    </div>
</div>
@stop