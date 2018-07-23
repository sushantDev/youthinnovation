@extends('backend.layouts.app')

@section('title', 'How we work?')

@section('content')
    <section>
        <div class="section-body">
            <div class="card">
                <div class="card-head">
                    <header class="text-capitalize">How we work?</header>
                    <div class="tools">
                        <a class="btn btn-primary ink-reaction" href="{{ route('how.create') }}">
                            <i class="md md-add"></i>
                            Add
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="10%">Body</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($hows as $how)
                            <tr>
                                <td>{{$how->id}}</td>
                                <td>{{ str_limit($how->body, 27) }}</td>

                                <td class="text-right">
                                    <a href="{{route('how.edit', $how->id)}}" class="btn btn-flat btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <button type="button" data-url="{{ route('how.destroy', $how->id) }}" class="btn btn-flat btn-primary btn-xs item-delete">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No data available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop