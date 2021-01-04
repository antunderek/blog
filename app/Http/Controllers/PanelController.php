<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('panel.index');
    }

    public function articles()
    {
        $articles = Article::all();
        return view('panel.articles', compact('articles'));
    }

    public function users()
    {
        $users = User::all();
        return view('panel.users', compact('users'));
    }
}
