<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGallery;
use App\Http\Requests\UpdateGallery;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $galleries = Gallery::latest()->get();

        return view('backend.gallery.index', compact('galleries'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.gallery.create');
    }

    /**
     * @param StoreGallery $request
     * @return mixed
     */
    public function store(StoreGallery $request)
    {
        DB::transaction(function () use ($request)
        {
            $data = $request->data();

            $gallery = Gallery::create($data);

            $this->uploadRequestImage($request, $gallery);

        });

        return redirect()->route('gallery.index')->withSuccess(trans('messages.create_success', [ 'entity' => 'Gallery' ]));
    }

    /**
     * @param Gallery $gallery
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Gallery $gallery)
    {
        return view('new', compact('gallery'));
    }

    /**
     * @param Gallery $gallery
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Gallery $gallery)
    {
        return view('backend.gallery.edit',compact('gallery'));
    }

    /**
     * @param UpdateGallery $request
     * @param Gallery $gallery
     * @return mixed
     */
    public function update(UpdateGallery $request, Gallery $gallery)
    {
        DB::transaction(function () use ($request, $gallery)
        {
            $data = $request->data();

            $gallery->update($data);

            $this->uploadRequestImage($request, $gallery);
        });

        return redirect()->route('gallery.index')->withSuccess(trans('messages.Update_success', [ 'entity' => 'Gallery' ]));
    }

    /**
     * @param Gallery $gallery
     * @return mixed
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->forceDelete();

        return back()->withSuccess(trans('message.delete_success', [ 'entity' => 'Gallery' ]));
    }
}
