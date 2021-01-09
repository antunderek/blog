<?php

namespace App\Http\Controllers;

use App\Article;
use App\Gallery;
use App\Http\Helpers\PermissionHandler;

use App\Http\Helpers\Validator;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $writer = false;
        if (Auth::check())
        {
            $writer = Role::where('id', Auth::user()->role_id)->first()->pluck('writer');
        }
        $articles = Article::all();
        return view('article.index', compact('articles', 'writer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        PermissionHandler::notWriterAbort();
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        PermissionHandler::notWriterAbort();
        Validator::validate($request, 'article');

        $article = new Article();
        $article->title = $request->title;
        $article->text = $request->text;
        $article->user_id = Auth::user()->id;

        if ($request->file('image')) {
            //$article->image_path = $request->file('image')->store('public/images');
            $image = new Gallery();
            $image->image_path = $request->file('image')->store('public/images');
            $image->save();
            $article->image_id = $image->id;
        }

        $article->save();

        return redirect()->route('article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
        PermissionHandler::noEditingPermissionsAbort($article);

        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
        PermissionHandler::noEditingPermissionsAbort($article);
        Validator::validate($request, 'article');

        $article->title = $request->title;
        $article->text = $request->text;
        $article->user_id = Auth::user()->id;

        if ($request->file('image'))
        {
            if ($article->image !== null)
            {
                //$article->image_path = $request->file('image')->store('images');
                $image = Gallery::where('id', $article->image_id)->get()->first();
                $image->image_path = $request->file('image')->store('public/images');
                $image->save();
                $article->image_id = $image->id;
            }
            else {
                // Repeating code
                $image = new Gallery();
                $image->image_path = $request->file('image')->store('public/images');
                $image->save();
                $article->image_id = $image->id;
            }
        }

        $article->save();


        return redirect()->route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
        PermissionHandler::noDestroyPermissionsAbort($article);
        Article::where('id', $article->id)->delete();

        if (URL::previous() === URL::route('panel.articles'))
        {
            return redirect()->back();
        }
        return redirect()->route('article.index');
    }
}
