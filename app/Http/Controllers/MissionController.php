<?php

namespace App\Http\Controllers;

use  App\Mission;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMission;
use App\Http\Requests\UpdateMission;
use Illuminate\Support\Facades\DB;
class MissionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $mission_data = Mission::latest()->get();

        return view('mission', compact('mission_data'));
    }
     public function index()
    {
        $missions = Mission::latest()->get();

        return view('backend.mission.index', compact('missions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.mission.create');
    }

    /**
     * @param Storemission $request
     * @return mixed
     */
    public function store(StoreMission $request)
    {
        DB::transaction(function () use ($request)
        {
            $data = $request->data();

            $mission = Mission::create($data);


        });

        return redirect()->route('mission.index')->withSuccess(trans('messages.create_success', [ 'entity' => 'Mission' ]));
    }

    /**
     * @param Mission $mission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Mission $mission)
    {
        return view('new', compact('mission'));
    }

    /**
     * @param Mission $mission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Mission $mission)
    {
        return view('backend.mission.edit',compact('mission'));
    }

    /**
     * @param UpdateMission $request
     * @param Mission $mission
     * @return mixed
     */
    public function update(UpdateMission $request, Mission $mission)
    {
        DB::transaction(function () use ($request, $mission)
        {
            $data = $request->data();

            $mission->update($data);

        
        });

        return redirect()->route('mission.index')->withSuccess(trans('messages.Update_success', [ 'entity' => 'Mission' ]));
    }

    /**
     * @param Mission $mission
     * @return mixed
     */
    public function destroy(Mission $mission)
    {
        $mission->forceDelete();

        return back()->withSuccess(trans('message.delete_success', [ 'entity' => 'Mission' ]));
    }
}
