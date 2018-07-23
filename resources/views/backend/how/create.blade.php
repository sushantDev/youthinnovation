@extends('backend.layouts.app')

@section('title', 'How We Work?')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::open(['route' =>'how.store','class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            @include('backend.how.partials.form', ['header' => 'Create how we work'])
            {{ Form::close() }}
        </div>
    </section>
@stop