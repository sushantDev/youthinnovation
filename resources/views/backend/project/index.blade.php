@extends('backend.layouts.app')

@section('title', 'News')

@section('content')
    <section>
        <div class="section-body">
            <div class="card">
                <div class="card-head">
                    <header class="text-capitalize">All News</header>
                    <div class="tools">
                        <a class="btn btn-primary ink-reaction" href="{{ route('project.create') }}">
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
                            <th width="10%" class="text-center">Author</th>
                            <th width="10%" class="text-center">Title</th>
                            <th width="10%" class="text-center">Type</th>
                            <th width="15%" class="text-center">Quote</th>
                            <th width="15%" class="text-center">body</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($news as $news)
                            <tr>
                                <td>{{$news->id}}</td>
                                <td>{{ str_limit($news->title, 27) }}</td>
                                <td class="text-center">{{ str_limit($news->author, 15) }}</td>
                                <td class="text-center">{{ str_limit($news->title, 15) }}</td>
                                <td class="text-center">{{ str_limit($news->type, 15) }}</td>
                                <td class="text-center">{{ str_limit($news->quote, 15) }}</td>
                                <td class="text-center">{{ str_limit($news->body, 15) }}</td>
                                <td class="text-right">
                                    <a href="{{route('project.edit', $news->id)}}" class="btn btn-flat btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <button type="button" data-url="{{ route('project.destroy', $news->id) }}" class="btn btn-flat btn-primary btn-xs item-delete">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No News available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop