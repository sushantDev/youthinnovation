<?php

namespace App\Http\ViewCreators;

use Illuminate\View\View;

class BackendMenuCreator
{

    /**
     * The user model.
     *
     * @var \App\User;
     */
    protected $user;

    /**
     * Create a new menu bar composer.
     */
    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function create(View $view)
    {
        $menu[] = [
            'class' => false,
            'route' => url('/home'),
            'icon'  => 'md md-home',
            'title' => 'Home'
        ];
        /*
         * Sample for adding menu
         * array_push($menu,
            [
                'class' => {desired class},
                'route' => {desired route or url},
                'icon'  => {md or fa icon class},
                'title' => {title},
                \\Optional Sub Menu Items
                'items' => [
                    ['route' => {route or url}, 'title' => {title}],
                    ...
                ]
            ]);
         */

     
         array_push($menu, [
            'class' => false,
            'route' => route('post.index'),
            'icon'  => 'md md-web',
            'title' => 'Posts'
        ]);

        array_push($menu, [
            'class' => false,
            'route' => route('user.index'),
            'icon'  => 'md md-accessibility',
            'title' => 'Users'
        ]);

//         array_push($menu, [
//            'class' => false,
//            'route' => route('news.index'),
//            'icon'  => 'md md-pages',
//            'title' => 'News'
//        ]);
         array_push($menu, [
            'class' => false,
            'route' => route('project.index'),
            'icon'  => 'md md-pages',
            'title' => 'Projects'
        ]);
         array_push($menu, [
            'class' => false,
            'route' => route('event.index'),
            'icon'  => 'md md-pages',
            'title' => 'Events'
        ]);
         array_push($menu, [
            'class' => false,
            'route' => route('gallery.index'),
            'icon'  => 'md md-pages',
            'title' => 'Gallery'
        ]);
        array_push($menu, [
            'class' => false,
            'route' => route('mission.index'),
            'icon'  => 'md md-pages',
            'title' => 'Mission'
        ]);

        array_push($menu, [
            'class' => false,
            'route' => route('how.index'),
            'icon'  => 'md md-pages',
            'title' => 'How we work?'
        ]);

        array_push($menu, [
            'class' => false,
            'route' => route('what.index'),
            'icon'  => 'md md-pages',
            'title' => 'What we do?'
        ]);
        $view->with('allMenu', $menu);
    }
}