@extends('backend.layouts.app')

@section('title', 'Projects')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::model($news, ['route' =>['project.update', $news->id],'class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            {{ method_field('PUT') }} @include('backend.project.partials.form', ['header' => 'Edit News <span class="text-primary">('.str_limit($news->title, 27).')</span>'])
            {{ Form::close() }}
        </div>
    </section>
@stop