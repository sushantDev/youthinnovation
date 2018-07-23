@extends('backend.layouts.app')

@section('title', 'Mission')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::model($mission, ['route' =>['mission.update', $mission->id],'class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            {{ method_field('PUT') }} @include('backend.mission.partials.form', ['header' => 'Edit Mission <span class="text-primary">('.str_limit($mission->title, 27).')</span>'])
            {{ Form::close() }}
        </div>
    </section>
@stop