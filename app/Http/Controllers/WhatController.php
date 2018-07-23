<?php

namespace App\Http\Controllers;

use  App\What;
use Illuminate\Http\Request;
use App\Http\Requests\StoreWhat;
use App\Http\Requests\UpdateWhat;
use Illuminate\Support\Facades\DB;

class WhatController extends Controller
{
    public function home()
    {
        $what_data = What::latest()->get();

        return view('what', compact('what_data'));
    }
     public function index()
    {
        $whats =What::latest()->get();

        return view('backend.what.index', compact('whats'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.what.create');
    }

    /**
     * @param StoreWhat $request
     * @return mixed
     */
    public function store(StoreWhat $request)
    {
        DB::transaction(function () use ($request)
        {
            $data = $request->data();

            $what = What::create($data);

            $this->uploadRequestImage($request, $what);

        });

        return redirect()->route('what.index')->withSuccess(trans('messages.create_success', [ 'entity' => 'What' ]));
    }

    /**
     * @param What $what
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sWhat(What $what)
    {
        return view('new', compact('what'));
    }

    /**
     * @param What $what
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(What $what)
    {
        return view('backend.what.edit',compact('what'));
    }

    /**
     * @param UpdateWhat $request
     * @param What $what
     * @return mixed
     */
    public function update(UpdateWhat $request, What $what)
    {
        DB::transaction(function () use ($request, $what)
        {
            $data = $request->data();

            $what->update($data);

         if ($request->image)
            {
                $this->uploadRequestImage($request, $what);
            }

        });

        return redirect()->route('what.index')->withSuccess(trans('messages.Update_success', [ 'entity' => 'What' ]));
    }

    /**
     * @param What $what
     * @return mixed
     */
    public function destroy(What $what)
    {
        $what->forceDelete();

        return back()->withSuccess(trans('message.delete_success', [ 'entity' => 'What' ]));
    }
}
