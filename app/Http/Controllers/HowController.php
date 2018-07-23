<?php

namespace App\Http\Controllers;

use  App\How;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHow;
use App\Http\Requests\UpdateHow;
use Illuminate\Support\Facades\DB;
class HowController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $how_data = How::latest()->get();

        return view('how', compact('how_data'));
    }
     public function index()
    {
        $hows =How::latest()->get();

        return view('backend.how.index', compact('hows'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.how.create');
    }

    /**
     * @param StoreHow $request
     * @return mixed
     */
    public function store(StoreHow $request)
    {
        DB::transaction(function () use ($request)
        {
            $data = $request->data();

            $how = How::create($data);

            $this->uploadRequestImage($request, $how);

        });

        return redirect()->route('how.index')->withSuccess(trans('messages.create_success', [ 'entity' => 'How' ]));
    }

    /**
     * @param How $how
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(How $how)
    {
        return view('new', compact('how'));
    }

    /**
     * @param How $how
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(How $how)
    {
        return view('backend.how.edit',compact('how'));
    }

    /**
     * @param UpdateHow $request
     * @param How $how
     * @return mixed
     */
    public function update(UpdateHow $request, How $how)
    {
        DB::transaction(function () use ($request, $how)
        {
            $data = $request->data();

            $how->update($data);
            if ($request->image)
            {
                $this->uploadRequestImage($request, $how);
            }

        
        });

        return redirect()->route('how.index')->withSuccess(trans('messages.Update_success', [ 'entity' => 'How' ]));
    }

    /**
     * @param How $how
     * @return mixed
     */
    public function destroy(How $how)
    {
        $how->forceDelete();

        return back()->withSuccess(trans('message.delete_success', [ 'entity' => 'How' ]));
    }
}
