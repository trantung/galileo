@extends('site.layout.default', array('seoMeta' => CommonSite::getMetaSeo(SEO_META)))

@section('title')
    {{-- @if($title = CommonSite::getMetaSeo(SEO_META)->title_site) --}}
        {{-- {{ $title = $title }} --}}
    {{-- @else --}}
        {{ $title = 'Trang chủ' }}
    {{-- @endif --}}
@stop

@section('content')
	@include('site.common.slide')
	@include('site.common.content_about')
	@include('site.common.introduce')
	@include('site.common.service')
	@include('site.common.partner')
	@include('site.common.bottom')

@stop
