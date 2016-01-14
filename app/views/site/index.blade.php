@extends('site.layout.default', array('seoMeta' => CommonSite::getMetaSeo(SEO_META)))

@section('title')
    {{-- @if($title = CommonSite::getMetaSeo(SEO_META)->title_site) --}}
        {{-- {{ $title = $title }} --}}
    {{-- @else --}}
        {{ $title = 'Trang chủ' }}
    {{-- @endif --}}
@stop

@section('content')
	
@stop

