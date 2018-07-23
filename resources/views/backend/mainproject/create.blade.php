@extends('backend.layouts.app')

@section('title', 'MainProject')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::open(['route' =>'mainproject.store','class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            @include('backend.mainproject.partials.form', ['header' => 'Create a MainProject'])
            {{ Form::close() }}
        </div>
    </section>
@stop