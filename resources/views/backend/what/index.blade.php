@extends('backend.layouts.app')

@section('title', 'What we do?')

@section('content')
    <section>
        <div class="section-body">
            <div class="card">
                <div class="card-head">
                    <header class="text-capitalize">What we do?</header>
                    <div class="tools">
                        <a class="btn btn-primary ink-reaction" href="{{ route('what.create') }}">
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
                            <th width="10%">Facts</th>
                            <th width="10%">Data</th>
                            <th width="10%">Spirit</th>
                            <th width="10%">Strategy</th>
                            <th width="10%">Advocacy</th>

                        </tr>
                        </thead>
                        <tbody>
                            @forelse($whats as $what)
                            <tr>
                                <td>{{$what->id}}</td>
                                <td>{{ str_limit($what->facts, 27) }}</td>
                                <td>{{ str_limit($what->data, 27) }}</td>
                                <td>{{ str_limit($what->spirit, 27) }}</td>
                                <td>{{ str_limit($what->strategy, 27) }}</td>
                                <td>{{ str_limit($what->advocacy, 27) }}</td>

                                <td class="text-right">
                                    <a href="{{route('what.edit', $what->id)}}" class="btn btn-flat btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <button type="button" data-url="{{ route('what.destroy', $what->id) }}" class="btn btn-flat btn-primary btn-xs item-delete">
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