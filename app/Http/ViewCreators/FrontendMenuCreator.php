<?php

namespace App\Http\ViewCreators;

use App\Menu;
use Illuminate\View\View;

class FrontendMenuCreator {

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
        $menus = Menu::orderBy('order', 'asc')->get();

        $view->with('allMenu', $menus);
    }
}