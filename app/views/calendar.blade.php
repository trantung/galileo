@extends('admin.layout.default')

@section('js_header')
@parent
    
@stop
@section('content')

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    <link rel="stylesheet" media="print" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.print.css"/>
    {{ $calendar->calendar() }}
    {{ $calendar->script() }}
@stop