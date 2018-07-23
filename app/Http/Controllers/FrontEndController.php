<?php

namespace App\Http\Controllers;

use App\Project;
use App\MainProject;
use Illuminate\Http\Request;


class FrontEndController extends Controller
{
    public function home()
    {
        $news=Project::latest()->get();
        $main_projects=MainProject::latest()->get();
        return view('welcome',compact('news','main_projects'));
    }
    public function yic()
    {
        $main_projects=MainProject::latest()->get();
        return view('yic',compact('main_projects'));
    }
    public function news2()
    {
        $main_news=Project::latest()->get();
        return view('news2',compact('main_news'));
    }
}
