<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Helpers\PermissionHandler;
use App\Http\Helpers\Validator;
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
        //PermissionHandler::noCommentEditorAbort();
        $this->authorize('viewAny', Comment::class);

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
        Validator::validate($request, 'comment');

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
        $this->authorize('update', $comment);
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
        $this->authorize('update', $comment);
        Validator::validate($request, 'comment_update');

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
        // Should be avoided, as it causes cascade delete on child comments.
        $this->authorize('delete', Comment::class);
        PermissionHandler::notDeleteCommentAbort();
        Comment::where('id', $comment->id)->delete();

        if (URL::previous() !== URL::route('comment.show', $comment))
        {
            return redirect()->route('panel.comments');
        }
        return redirect()->back();
    }

   /**
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Comment  $comment
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request, Comment $comment)
    {
        // Default way to delete comments, this is a non destructive of deleting comments in order to preserve child comments.
        $this->authorize('update', $comment);

        $comment->comment = "Comment has been deleted.";
        $comment->save();

        return redirect()->back();
    }
}
