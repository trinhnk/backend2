<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function store(StoreArticleRequest $request) {
        $article = new Article;
        $article->title     = $request->title;
        $article->slug      = $request->slug;
        $article->description = $request->description;
        $article->content   = $request->content;
        $article->user_id   = Auth::user()->id;
        $article->category_id  = $request->category_id;
        $article->status    = 1;
        $article->save();
        // $article->addToIndex();

        return (new ArticleResource($article));
    }

    public function index() {
        $article = Article::latestFirst()->paginate(2);
        // dd($article->lastPage());
        return ArticleResource::collection($article);
    }

    public function show(Article $article) {
        return new ArticleResource($article);
    }
}
