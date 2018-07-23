@extends('backend.layouts.app')

@section('title', 'Gallery')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::open(['route' =>'gallery.store','class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            @include('backend.gallery.partials.form', ['header' => 'Create a Gallery'])
            {{ Form::close() }}
        </div>
    </section>
@stop