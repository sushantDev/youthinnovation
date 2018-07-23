@extends('layouts.app')

@section('content')
    @include('partials.slider')
    @include('partials.projects')
    @include('partials.smallslider')
    @include('partials.homeless')
    @include('partials.events')
    @include('partials.news')
    {{--@include('partials.maps')--}}
    @include('partials.map')
    {{--@include('partials.footer')--}}
@stop
