<?php

namespace App\Http\Controllers;

use App\Article;
use App\Gallery;
use App\Http\Traits\SearchTrait;
use App\Role;
use App\Http\Helpers\Validator;
use App\Http\Traits\ArticleGalleryTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    use ArticleGalleryTrait;
    use SearchTrait;

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show', 'searchIndex');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user = null)
    {
        //
        $writer = false;
        if (Auth::check())
        {
            $writer = Role::where('id', Auth::user()->role_id)->first()->pluck('writer');
        }
        // Order by updated_at
        if ($user == null)
        {
            $articles = Article::orderBy('created_at', 'desc')->paginate(10);
        }
        else
        {
            $articles = Article::where('user_id', $user)->orderBy('created_at', 'desc')->paginate(10);
        }

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

        return redirect()->route('article.index')->with('success', 'Article successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($article)
    {
        //
        $article = Article::withTrashed()->where('id', $article)->first();
        $trashed = Article::onlyTrashed()->where('id', $article)->first();
        if ($trashed && !(Auth::id() === $article->user_id && Auth::user()->role->writer || Auth::user()->role->edit_article))
        {
            abort(404);
        }
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
                $this->storeParameters($request, $image);
                $article->image_id = $image->id;
            }
            else {
                $article->image_id = $this->createStoreImage($request);
            }
        }

        $article->save();

        return redirect()->route('article.index')->with('success', 'Successfully updated article');
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

        if (!Auth::user()->role->edit_article) {
            return redirect()->route('panel.articles.user')->with('success', 'Successfully deleted article');
        }
        return redirect()->route('panel.articles')->with('success', 'Successfully deleted article');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function restore(string $id)
    {
        $article = Article::withTrashed()->find($id);
        $this->authorize('restore', $article);
        Article::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'Successfully restored article');
    }

    public function searchIndex(Request $request)
    {
        // Front page articles
        $columns = ['id', 'title', 'text', 'created_at', 'updated_at'];
        $query = Article::select();
        $articles = $this->search($query, $columns, $request->keyword, true, 10);
        $writer = false;
        if (Auth::check())
        {
            $writer = Role::where('id', Auth::user()->role_id)->first()->pluck('writer');
        }
        return view('article.index', compact('articles', 'writer'));
    }

    public function allArticles($user = null)
    {
        $this->authorize('panelArticles', Article::class);

        if ($user == null)
        {
            $articles= Article::withTrashed()->get();
        }
        else {
            $articles= Article::withTrashed()->where('user_id', $user)->get();
        }

        return view('panel.articles', compact('articles'));
    }

    public function searchAllArticles(Request $request)
    {
        // Panel for article editors only, includes soft deleted objects
        $this->authorize('panelArticles', Article::class);

        $columns = ['id', 'title', 'text'];
        $query = Article::withTrashed()->select();
        $articles = $this->search($query, $columns, $request->keyword, true, 30);

        return view('panel.articles', compact('articles'));
    }

    public function userArticles()
    {
        $this->authorize('panelUserArticles', Article::class);
        $articles = Article::withTrashed()->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('panel.articles', compact('articles'));
    }

    public function searchUserArticles(Request $request)
    {
        // Panel user articles only
        $this->authorize('panelUserArticles', Article::class);

        $columns = ['id', 'title', 'text'];
        $query = Article::withTrashed()->select();
        $articles = $this->idRestrictedSearch($query, $columns, $request->keyword, true, 30);
        $user = true;
        return view('panel.articles', compact('articles', 'user'));
    }

    private function createStoreImage(Request $request) {
        $image = new Gallery();
        $image = $this->storeParameters($request, $image);
        return $image->id;
    }
}
