<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request) {
        $comment = new Comment;
        $comment->content       = $request->content;
        $comment->article_id    = $request->article_id;
        $comment->user_id       = Auth::user()->id;
        $comment->status        = 1;
        $comment->save();

        return new CommentResource($comment);
    }

    public function showByArticle($article) {
        $comments = Comment::where('article_id', $article)->latestFirst()->paginate(10);
        return CommentResource::collection($comments);
    }

    public function destroy(Comment $comment) {
		$comment->delete();
		return response(null, 204);
	}
}
