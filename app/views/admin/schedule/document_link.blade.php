@extends('admin.layout.default')

@section('title')
@stop

@section('content')

    <div class="col-xs-12">
        <div class="box box-primary">
                @if(count($documents) > 0)
                    @foreach($documents as $document)
                        <div class="col-sm-6">
                            <div class="well well-sm">  
                                @if($doc = Common::getDocumentByParentId($document->parent_id, P))
                                <fieldset>
                                    <legend>Phiếu câu hỏi {{ $doc->parent_id }}</legend>
                                    <div class="display-inline-block">
                                        <a target="_blank" href="{{ asset($doc->file_url) }}">{{ $doc->code }}</a><br>
                                    </div>
                                @endif
                                </fieldset>
                                <fieldset>
                                @if(Common::getDocumentByParentId($doc->parent_id, D))
                                    <legend>Phiếu đáp án {{ $doc->parent_id }}</legend>
                                     <div class="display-inline-block">
                                        <a target="_blank" href="{{ asset($doc->file_url) }}">{{ $doc->code }}</a><br>
                                    </div>
                                </fieldset>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else   
                    <div class="col-sm-6">
                        'Chưa có tài liệu nào'
                    </div>
                @endif
            <div class="clear clearfix"></div>
        </div>
    </div>
@stop
