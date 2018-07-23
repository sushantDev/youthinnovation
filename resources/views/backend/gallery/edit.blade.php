@extends('backend.layouts.app')

@section('title', 'Gallery')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::model($gallery, ['route' =>['gallery.update', $gallery->id],'class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            {{ method_field('PUT') }} @include('backend.gallery.partials.form', ['header' => 'Edit Galley <span class="text-primary">('.str_limit($gallery->title, 27).')</span>'])
            {{ Form::close() }}
        </div>
    </section>
@stop