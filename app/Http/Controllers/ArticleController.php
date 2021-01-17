<?php

namespace App\Http\Controllers;

use App\Article;
use App\Gallery;
use App\Role;
use App\Http\Helpers\Validator;
use App\Http\Traits\ArticleGalleryTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ArticleController extends Controller
{
    use ArticleGalleryTrait;

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
        $articles = Article::paginate(10);

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
        $this->authorize('create', Article::class);

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
        $this->authorize('create', Article::class);
        Validator::validate($request, 'article');

        $article = new Article();
        $article->title = $request->title;
        $article->text = $request->text;
        $article->user_id = Auth::id();

        if ($request->file('image')) {
            $article->image_id = $this->createStoreImage($request);
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
        $this->authorize('update', $article);

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
        $this->authorize('update', $article);
        Validator::validate($request, 'article');

        $article->title = $request->title;
        $article->text = $request->text;
        $article->user_id = Auth::id();

        if ($request->file('image'))
        {
            if ($article->image !== null)
            {
                $image = Gallery::where('id', $article->image_id)->get()->first();
                Storage::delete($image->image_path);
                $image->image_path = $request->file('image')->store('public/images');
                $image->save();
                $article->image_id = $image->id;
            }
            else {
                $article->image_id = $this->createStoreImage($request);
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
        $this->authorize('delete', $article);
        Article::where('id', $article->id)->delete();

        if (URL::previous() === URL::route('panel.articles'))
        {
            return redirect()->back();
        }

        return redirect()->route('article.index');
    }


    public function restore($id)
    {
        Article::withTrashed()->find($id)->restore();
        return redirect()->back();
    }

    public function allArticles()
    {
        $this->authorize('panelArticles', Article::class);
        $articles = Article::withTrashed()->paginate(50);
        return view('panel.articles', compact('articles'));
    }

    public function userArticles()
    {
        $this->authorize('panelUserArticles', Article::class);
        $articles = Article::withTrashed()->where('user_id', Auth::id())->paginate(10);
        return view('panel.articles', compact('articles'));
    }

    private function createStoreImage(Request $request) {
        $image = new Gallery();
        $image = $this->storeParameters($request, $image);
        return $image->id;
    }
}
