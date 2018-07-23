@extends('backend.layouts.app')

@section('title', 'What we do')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::model($what, ['route' =>['what.update', $what->id],'class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            {{ method_field('PUT') }} @include('backend.what.partials.form', ['header' => 'Edit What we do <span class="text-primary">('.str_limit($what->title, 27).')</span>'])
            {{ Form::close() }}
        </div>
    </section>
@stop