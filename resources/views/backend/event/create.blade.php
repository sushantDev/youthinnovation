@extends('backend.layouts.app')

@section('title', 'Event')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::open(['route' =>'event.store','class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            @include('backend.event.partials.form', ['header' => 'Create an Event'])
            {{ Form::close() }}
        </div>
    </section>
@stop