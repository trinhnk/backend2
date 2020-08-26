<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Article;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function store(StoreArticleRequest $request) {
        $article = new Article;
        $article->title     = $request->title;
        // $article->slug      = $request->slug;
        $article->description = $request->description;
        $article->content   = $request->content;
        $article->user_id   = Auth::user()->id;
        $article->category_id  = $request->category_id;
        $article->status    = 1;
        $article->save();
        // $article->addToIndex();

        return (new ArticleResource($article));
    }

    public function update(UpdateArticleRequest $request, Article $article) {
        // dd(Auth::user());
        // if (Auth::user()->) {

        // }
        $this->authorize('update', $article);
        $article->title        = $request->get('title', $article->title);
        $article->description  = $request->description;
        $article->content   = $request->content;
        $article->category_id  = $request->category_id;
		$article->save();
		return new ArticleResource($article);
    }
    
    public function destroy(Article $article) {
		$this->authorize('destroy', $article);
		$article->delete();
		return response(null, 204);
	}

    public function index() {
        $article = Article::latestFirst()->paginate(5);
        // dd($article->lastPage());
        return ArticleResource::collection($article);
    }

    public function show(Article $article) {
        return new ArticleResource($article);
    }

    public function showByUser($user_id) {
        $article = Article::where('user_id', $user_id)->latestFirst()->paginate(5);
        return ArticleResource::collection($article);
    }
}
