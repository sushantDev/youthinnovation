@extends('backend.layouts.app')

@section('title', 'How')

@section('content')
    <section>
        <div class="section-body">
            {{ Form::model($how, ['route' =>['how.update', $how->id],'class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate']) }}
            {{ method_field('PUT') }} @include('backend.how.partials.form', ['header' => 'Edit How we work <span class="text-primary">('.str_limit($how->title, 27).')</span>'])
            {{ Form::close() }}
        </div>
    </section>
@stop