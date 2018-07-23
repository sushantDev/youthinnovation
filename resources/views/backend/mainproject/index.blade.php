@extends('backend.layouts.app')

@section('title', 'MainProject')

@section('content')
    <section>
        <div class="section-body">
            <div class="card">
                <div class="card-head">
                    <header class="text-capitalize">All MainProject</header>
                    <div class="tools">
                        <a class="btn btn-primary ink-reaction" href="{{ route('mainproject.create') }}">
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
                            <th width="5%">Author</th>
                            <th width="10%">Moto</th>
                            <th width="5%">Title</th>
                            <th width="5%">About Title</th>
                            <th width="10%">Title Description</th>
                            <th width="10%">Problem&Context</th>
                            <th width="10%">Problem Description</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($mainprojects as $mainproject)
                            <tr>
                                <td>{{$mainproject->id}}</td>
                                <td>{{ str_limit($mainproject->author, 15) }}</td>
                                <td>{{ str_limit($mainproject->moto, 15) }}</td>
                                <td>{{ str_limit($mainproject->title, 15) }}</td>
                                <td>{{ str_limit($mainproject->about_title, 15) }}</td>
                                <td>{{ str_limit($mainproject->title_description, 15) }}</td>
                                <td>{{ str_limit($mainproject->problem_context, 15) }}</td>
                                <td>{{ str_limit($mainproject->problem_description, 15) }}</td>
                                <td class="text-right">
                                    <a href="{{route('mainproject.edit', $mainproject->id)}}" class="btn btn-flat btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <button type="button" data-url="{{ route('mainproject.destroy', $mainproject->id) }}" class="btn btn-flat btn-primary btn-xs item-delete">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No MainProject available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop