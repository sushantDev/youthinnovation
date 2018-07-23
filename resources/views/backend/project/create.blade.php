@extends('backend.layouts.app')

@section('title', 'Project')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::open(['route' =>'project.store','class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            @include('backend.project.partials.form', ['header' => 'Create a News'])
            {{ Form::close() }}
        </div>
    </section>
@stop