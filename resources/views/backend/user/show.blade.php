@extends('backend.layouts.app')

@section('title', 'Users Profile')

@section('content')
<!-- BEGIN PROFILE HEADER -->
{{ Form::model($user, ['route' => ['user.update', $user->name], 'class' => 'form form-validate', 'method' => 'PUT', 'role' => 'form', 'files' => true, 'novalidate' ]) }}
<input type="hidden" name="status" value="1">
<section class="full-bleed">
    <div class="section-body style-default-dark force-padding">
        <div class="img-backdrop" style="background-image: url('{{ asset('img/login-bg.jpg') }}')"></div>
        <div class="overlay overlay-shade-top stick-top-left height-3"></div>
        <div class="row margin-bottom-xxl">
            <div class="col-md-3 col-xs-5">
                <div class="row text-center">
                    <img class="img-circle border-white border-xl auto-width preview" src="" alt="user_avatar" style="width: 140px;"/>
                </div>
            </div>
            <div class="col-md-9 col-xs-7">
                <div class="width-4 text-center pull-right">
                    @unless(empty($user->created_at))
                        <strong class="text-xl">{{ $user->created_at }}</strong><br/>
                        <span class="text-light opacity-75">Date Joined</span>
                        <br/>
                        <br/>
                    @endunless
                </div>
            </div>
        </div>
        @include('partials.errors')
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-underline">
                            <div class="card-head">
                                <header>
                                    <small>Personal info</small>
                                </header>
                                <div class="tools">
                                    <a href="{{ route('user.edit', $user->slug) }}" class="btn btn-primary">Edit</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list">
                                    <li class="tile">
                                        <a class="tile-content">
                                            <div class="tile-icon">
                                                <i class="md md-border-color"></i>
                                            </div>
                                            <div class="tile-text">
                                                {{ $user->name }}
                                            </div>
                                        </a>
                                    </li>

                                    <li class="tile">
                                        <a class="tile-content">
                                            <div class="tile-icon">
                                                <i class="md md-insert-link"></i>
                                            </div>
                                            <div class="tile-text">
                                                {{ $user->slug }}
                                            </div>
                                        </a>
                                    </li>
                                    <li class="tile">
                                        <a class="tile-content">
                                            <div class="tile-icon">
                                                <i class="md md-insert-link"></i>
                                            </div>
                                            <div class="tile-text">
                                                {{ $user->email }}
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{ Form::close() }}
        <!-- END PROFILE HEADER  -->
@stop

@push('scripts')
<script src="{{ asset('js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
<script src="{{ asset('js/preview.js') }}"></script>
<script>
    (function () {
        "use strict";
        $.validator.setDefaults({
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            }
        });
    }());
    $(".form-validate-password").validate({
        rules: {
            password: {
                minlength: 8,
                required: true,
                character: true,
                uppercase: true,
                lowercase: true,
                number: true
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            password: {
                character: "Must have one these characters !@#$%^&*-",
                uppercase: "Must have at least one uppercase character",
                lowercase: "Must have at least one lowercase character",
                number: "Must have at least one number"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
    $.validator.addMethod("character", function (value) {
        return /[!@#$%^&*-]/.test(value);
    });
    $.validator.addMethod("lowercase", function (value) {
        return /[a-z]/.test(value);
    });
    $.validator.addMethod("uppercase", function (value) {
        return /[A-Z]/.test(value);
    });
    $.validator.addMethod("number", function (value) {
        return /\d/.test(value);
    });
    $.validator.addMethod("nospaces", function (value) {
        return value.indexOf(" ") < 0;
    });
</script>
@endpush
