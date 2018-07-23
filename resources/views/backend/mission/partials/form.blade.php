    <div class="row">
    <div class="col-md-12">
        @include('partials.errors')
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-head">
                <header>{!! $header !!}</header>
                <div class="tools visible-xs">
                    <a class="btn btn-default btn-ink" onclick="history.go(-1);return false;">
                        <i class="md md-arrow-back"></i>
                        Back
                    </a>
                    <input type="submit" name="draft" class="btn btn-info ink-reaction" value="Save Draft">
                    <input type="submit" name="publish" class="btn btn-primary ink-reaction" value="Publish">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::text('learn',old('learn'),['class'=>'form-control', 'required']) }}
                            {{ Form::label('learn','Learn*') }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::text('connect',old('connect'),['class'=>'form-control', 'required']) }}
                            {{ Form::label('connect','Connect*') }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::text('serve',old('serve'),['class'=>'form-control', 'required']) }}
                            {{ Form::label('serve','Serve*') }}
                        </div>
                    </div>
                </div>
                {{--<div class="row">--}}
                    {{--<div class="col-sm-12">--}}
                        {{--<label class="text-default-light">Featured Image</label>--}}
                        {{--@if(isset($event) && $event->image)--}}
                            {{--<input type="file" name="image" class="dropify" data-default-file="{{ asset($event->image->thumbnail(260,198)) }}"/>--}}
                        {{--@else--}}
                            {{--<input type="file" name="image" class="dropify"/>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}

            </div>
            </div>
            <div class="card-actionbar">
                <div class="card-actionbar-row">
                    <button type="reset" class="btn btn-default ink-reaction">Reset</button>
                    <input type="submit" name="draft" class="btn btn-info ink-reaction" value="Save Draft">
                    {{--<input type="submit" name="publish" class="btn btn-primary ink-reaction" value="{{ isset($post) && $post->is_published ? 'Save' : 'Publish' }}">--}}
                </div>
            </div>
        </div>
    </div>
@push('styles')
    <link href="{{ asset('backend/css/libs/dropify/dropify.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/backend/css/bootstrap-select.min.css') }}">
@endpush

