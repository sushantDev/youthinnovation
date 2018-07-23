<?php

namespace App\Http\Controllers;

use App\MainProject;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMainProject;
use App\Http\Requests\UpdateMainProject;
use Illuminate\Support\Facades\DB;

class MainProjectController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $mainprojects = MainProject::latest()->get();

        return view('backend.mainproject.index', compact('mainprojects'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.mainproject.create');
    }

    /**
     * @param StoreMainProject $request
     * @return mixed
     */
    public function store(StoreMainProject $request)
    {
        DB::transaction(function () use ($request)
        {
            $data = $request->data();

            $mainproject = MainProject::create($data);

            $this->uploadRequestImage($request, $mainproject);

        });

        return redirect()->route('mainproject.index')->withSuccess(trans('messages.create_success', [ 'entity' => 'MainProject' ]));
    }

    /**
     * @param MainProject $mainproject
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(MainProject $main_project)
    {
        return view('main_project', compact('main_project'));
    }

    /**
     * @param MainProject $mainproject
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(MainProject $mainproject)
    {
        return view('backend.mainproject.edit',compact('mainproject'));
    }

    /**
     * @param UpdateMainProject $request
     * @param MainProject $mainproject
     * @return mixed
     */
    public function update(UpdateMainProject $request, MainProject $mainproject)
    {
        DB::transaction(function () use ($request, $mainproject)
        {
            $mainproject->update($request->data());

            if ($request->image)
            {
                $this->uploadRequestImage($request, $mainproject);
            }
        });

        return redirect()->route('mainproject.index')->withSuccess(trans('messages.update_success', [ 'entity' => 'MainProject' ]));
    }

    /**
     * @param MainProject $mainproject
     * @return mixed
     */
    public function destroy(MainProject $mainproject)
    {
        $mainproject->delete();

        return back()->withSuccess(trans('message.delete_success', [ 'entity' => 'MainProject' ]));
    }

}
