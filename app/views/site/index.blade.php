@extends('site.layout.default')

@section('title')
    {{ $title = 'Trang chủ' }}
@stop

@section('content')
	@include('site.common.slide')
	@include('site.common.content_about')
	@include('site.common.introduce')
	@include('site.common.newsbox')
	@include('site.common.partner')
	@include('site.common.bottom')

@stop
