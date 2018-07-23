@extends('backend.layouts.app')

@section('title', 'Event')

@section('content')
    <section>
        <div class="section-body">
            <div class="card">
                <div class="card-head">
                    <header class="text-capitalize">All Events</header>
                    <div class="tools">
                        <a class="btn btn-primary ink-reaction" href="{{ route('event.create') }}">
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
                            <th width="10%">Venue</th>
                            <th width="20%" class="text-center">Detail</th>
                            <th width="20%" class="text">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                            <tr>
                                <td>{{$event->id}}</td>
                                <td>{{ str_limit($event->venue, 27) }}</td>
                                <td class="text-center">{{ str_limit($event->detail, 27) }}</td>
                                <td>{{ str_limit($event->date, 27) }}</td>

                                <td class="text-right">
                                    <a href="{{route('event.edit', $event->id)}}" class="btn btn-flat btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <button type="button" data-url="{{ route('event.destroy', $event->id) }}" class="btn btn-flat btn-primary btn-xs item-delete">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No Events available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop