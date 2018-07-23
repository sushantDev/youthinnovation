<?php

namespace App\Http\ViewCreators;

use App\Slide;
use Illuminate\View\View;

class FrontendSliderCreator {

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function create(View $view)
    {
        $slides = Slide::published()->orderBy('order', 'asc')->get();

        $allSlides = [];

        foreach ($slides as $key => $slide)
        {
            array_push($allSlides, [
                'slug'         => str_slug($slide->title ?: 'slide ' . $key),
                'title'        => empty($slide->title) ? null : $slide->title,
                'caption'      => empty($slide->caption) ? null : $slide->caption,
                'link_url'     => empty($slide->link_url) ? null : $slide->link_url,
                'link_caption' => empty($slide->link_caption) ? null : $slide->link_caption,
                'image'        => $slide->image && file_exists(public_path($slide->image->path)) ? $slide->image->resize(1920, 1080) : '/img/post-placeholder.png'
            ]);
        }

        $view->with('slides', $allSlides);
    }
}