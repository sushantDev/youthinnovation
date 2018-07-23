@extends('backend.layouts.app')

@section('title', 'MainProject')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::model($mainproject, ['route' =>['mainproject.update', $mainproject->id],'class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            {{ method_field('PUT') }} @include('backend.mainproject.partials.form', ['header' => 'Edit MainProject <span class="text-primary">('.str_limit($mainproject->title, 27).')</span>'])
            {{ Form::close() }}
        </div>
    </section>
@stop