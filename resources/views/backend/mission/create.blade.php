@extends('backend.layouts.app')

@section('title', 'Mission')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::open(['route' =>'mission.store','class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            @include('backend.mission.partials.form', ['header' => 'Create a Mission'])
            {{ Form::close() }}
        </div>
    </section>
@stop