<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Article;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(StoreCategoryRequest $request) {
		    $category = new Category;
        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->description = $request->description;
		    $category->save();

		    return (new CategoryResource($category));
    }
    
    public function index() {
		    $category = Category::latestFirst()->paginate(10);
		    return CategoryResource::collection($category);
    }
    
    public function show(Category $category) {
		    return new CategoryResource($category);
    }
    
    public function update(UpdateCategoryRequest $request, Category $category) {
        $category->title        = $request->get('title', $category->title);
        $category->slug         = $request->slug;
        $category->description  = $request->description;
		$category->save();
		return new CategoryResource($category);
	}

	public function categoryDetails(Category $category) {
		$article = Article::where('category_id', $category->id)->latestFirst()->paginate(10);
        return ArticleResource::collection($article);
	}
}
