<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Helpers\PermissionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        PermissionHandler::noCommentEditorAbort();
        $comments = Comment::all();
        return view('comment.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $comment = new Comment();
        $comment->article_id = $request->article;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        if ($request->parent)
        {
            $comment->parent_id = $request->parent;
        }

        $comment->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
        return view('comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
        if ($comment->user_id !== Auth::id())
        {
            PermissionHandler::notEditCommentAbort();
        }
        return view('comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
        if ($comment->user_id !== Auth::id())
        {
            PermissionHandler::notEditCommentAbort();
        }

        $comment->comment = $request->comment;

        $comment->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
        if ($comment->user_id !== Auth::id())
        {
            PermissionHandler::notDeleteCommentAbort();
        }
        Comment::where('id', $comment->id)->delete();

        if (URL::previous() !== URL::route('comment.show'))
        {
            return redirect()->route('panel.comments');
        }
        return redirect()->back();
    }
}
