@extends('backend.layouts.app')

@section('title', 'Mission')

@section('content')
    <section>
        <div class="section-body">
            <div class="card">
                <div class="card-head">
                    <header class="text-capitalize">All Missions</header>
                    <div class="tools">
                        <a class="btn btn-primary ink-reaction" href="{{ route('mission.create') }}">
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
                            <th width="10%">Learn</th>
                            <th width="20%" class="text-center">Connect</th>
                            <th width="20%" class="text">Serve</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($missions as $mission)
                            <tr>
                                <td>{{$mission->id}}</td>
                                <td>{{ str_limit($mission->learn, 27) }}</td>
                                <td class="text-center">{{ str_limit($mission->connect, 27) }}</td>
                                <td>{{ str_limit($mission->serve, 27) }}</td>

                                <td class="text-right">
                                    <a href="{{route('mission.edit', $mission->id)}}" class="btn btn-flat btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <button type="button" data-url="{{ route('mission.destroy', $mission->id) }}" class="btn btn-flat btn-primary btn-xs item-delete">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No missions available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop