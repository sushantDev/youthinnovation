@extends('backend.layouts.app')

@section('title', 'Gallery')

@section('content')
    <section>
        <div class="section-body">
            <div class="card">
                <div class="card-head">
                    <header class="text-capitalize">All Gallery</header>
                    <div class="tools">
                        <a class="btn btn-primary ink-reaction" href="{{ route('gallery.create') }}">
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
                            <th width="10%">Title</th>
                            <th width="20%" class="text-center">Description</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($galleries as $gallery)
                            <tr>
                                <td>{{$gallery->id}}</td>
                                <td>{{ str_limit($gallery->title, 27) }}</td>
                                <td class="text-center">{{ str_limit($gallery->descr, 27) }}</td>
                                <td class="text-right">
                                    <a href="{{route('gallery.edit', $gallery->id)}}" class="btn btn-flat btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <button type="button" data-url="{{ route('gallery.destroy', $gallery->id) }}" class="btn btn-flat btn-primary btn-xs item-delete">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No Gallery available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop