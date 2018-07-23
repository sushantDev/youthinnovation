<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Tag;
use App\News;
use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();

        return view('backend.post.index', compact('news'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        return view('backend.post.create');
    }

    /**
     * @param StoreNews $request
     * @return mixed
     */
    public function store(StoreNews $request)
    {
        DB::transaction(function () use ($request)
        {
            $data = $request->data();

            $news = News::create($data);

            $this->uploadRequestImage($request, $news);

        });

        return redirect()->route('news.index')->withSuccess(trans('messages.create_success', [ 'entity' => 'News' ]));
    }

    /**
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(News $news)
    {
        return view($news->view, compact('news'));
    }

    /**
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(News $news)
    {


        return view('backend.news.edit',compact('news'));
    }

    /**
     * @param UpdateNews $request
     * @param News $news
     * @return mixed
     */
    public function update(UpdateNews $request, News $news)
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
     * @param News $news
     * @return mixed
     */
    public function destroy(News $news)
    {

        $news->delete();

        return back()->withSuccess(trans('message.delete_success', [ 'entity' => 'News' ]));
    }
}
