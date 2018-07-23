@extends('backend.layouts.app')

@section('title', 'What we do')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::open(['route' =>'what.store','class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            @include('backend.what.partials.form', ['header' => 'Create what we do'])
            {{ Form::close() }}
        </div>
    </section>
@stop