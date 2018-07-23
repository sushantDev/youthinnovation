<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProject;
use App\Http\Requests\UpdateProject;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $news = Project::latest()->get();

        return view('backend.project.index', compact('news'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.project.create');
    }

    /**
     * @param StoreProject $request
     * @return mixed
     */
    public function store(StoreProject $request)
    {
        DB::transaction(function () use ($request)
        {
            $data = $request->data();

            $project = Project::create($data);

            $this->uploadRequestImage($request, $project);

        });

        return redirect()->route('project.index')->withSuccess(trans('messages.create_success', [ 'entity' => 'News' ]));
    }

    /**
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Project $news)
    {
        return view('news2', compact('news'));
    }

    /**
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Project $news)
    {
        return view('news2',compact('news'));
    }

    /**
     * @param UpdateProject $request
     * @param Project $project
     * @return mixed
     */
    public function update(UpdateProject $request, Project $news)
    {
        DB::transaction(function () use ($request, $news)
        {
            $data = $request->data();

            $news->update($data);

            $this->uploadRequestImage($request, $news);
        });

        return redirect()->route('news.index')->withSuccess(trans('messages.Update_success', [ 'entity' => 'News' ]));
    }

    /**
     * @param Project $project
     * @return mixed
     */
    public function destroy(Project $news)
    {
        $news->forceDelete();

        return back()->withSuccess(trans('message.delete_success', [ 'entity' => 'News' ]));
    }
}
