<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEvent;
use App\Http\Requests\UpdateEvent;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $events = Event::latest()->get();

        return view('backend.event.index', compact('events'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.event.create');
    }

    /**
     * @param StoreEvent $request
     * @return mixed
     */
    public function store(StoreEvent $request)
    {
        DB::transaction(function () use ($request)
        {
            $data = $request->data();

            $event = Event::create($data);

            $this->uploadRequestImage($request, $event);

        });

        return redirect()->route('event.index')->withSuccess(trans('messages.create_success', [ 'entity' => 'Events' ]));
    }

    /**
     * @param Event $event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Event $event)
    {
        return view('new', compact('event'));
    }

    /**
     * @param Event $event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Event $event)
    {
        return view('backend.event.edit',compact('event'));
    }

    /**
     * @param UpdateEvent $request
     * @param Event $event
     * @return mixed
     */
    public function update(UpdateEvent $request, Event $event)
    {
        DB::transaction(function () use ($request, $event)
        {
            $data = $request->data();

            $event->update($data);

            $this->uploadRequestImage($request, $event);
        });

        return redirect()->route('event.index')->withSuccess(trans('messages.Update_success', [ 'entity' => 'Events' ]));
    }

    /**
     * @param Event $event
     * @return mixed
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return back()->withSuccess(trans('message.delete_success', [ 'entity' => 'Events' ]));
    }
}
