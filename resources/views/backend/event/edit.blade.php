@extends('backend.layouts.app')

@section('title', 'Event')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::model($event, ['route' =>['event.update', $event->id],'class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            {{ method_field('PUT') }} @include('backend.event.partials.form', ['header' => 'Edit Event <span class="text-primary">('.str_limit($event->title, 27).')</span>'])
            {{ Form::close() }}
        </div>
    </section>
@stop